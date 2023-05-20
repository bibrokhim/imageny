<template>
  <FolderTopBar
    :breadcrumbs="breadcrumbs"
    :selected-folder="selectedFolder"
    :selected-image="selectedImage"
    @clear-selections="clearSelections"
  />
  <div
    class="grid gap-2 grid-cols-2 md:grid-cols-6 xl:grid-cols-8 mt-12"
    @click.self="clearSelections"
  >
    <FolderCreateLink :current-folder="currentFolder" />
    <ImageCreate
      v-if="route().current() !== 'folders.index'"
      :current-folder="currentFolder"
    />
    <template
      v-for="folder in folderModels"
      :key="folder.id"
    >
      <Folder
        :folder="folder"
        @click="selectElement(folder)"
        @dblclick="$inertia.visit(route('folders.show', folder.id))"
      />
    </template>
    <template
      v-for="image in imageModels"
      :key="image.id"
    >
      <ImageBase
        :image="image"
        @click="selectElement(image)"
        @dblclick="$inertia.get(route('images.show', image.id))"
      />
    </template>
  </div>
  <PaginationSimple
    v-if="images"
    :links="images.links"
  />
</template>

<script setup>
import Folder from "../Shared/FolderBase.vue";
import FolderCreateLink from "./FolderCreate.vue";
import FolderModel from "../Models/Folder";
import FolderTopBar from "../Shared/FolderTopBar.vue";
import ImageCreate from "./ImageCreate.vue";
import ImageBase from "./ImageBase.vue";
import ImageModel from "../Models/Image";
import PaginationSimple from "./PaginationSimple.vue";
import { ref, watch } from "vue";

const props = defineProps({
  folders: {
    type: Array,
    default: () => []
  },
  images: {
    type: Object,
    default: () => {}
  },
  breadcrumbs: {
    type: Array,
    default: () => []
  },
  currentFolder: {
    type: Object,
    default: () => ({})
  }
});
const folderModels = ref(props.folders.map(folder => new FolderModel(folder)));
const imageModels = ref(props.images?.data.map(image => new ImageModel(image)) ?? []);
const selectedFolder = ref(null);
const selectedImage = ref(null);

watch(props, (newProps) => {
  folderModels.value = newProps.folders.map(folder => new FolderModel(folder));
  imageModels.value = newProps.images?.data.map(image => new ImageModel(image)) ?? [];
});

function selectElement(el) {
  folderModels.value.map(function (folder) {
    folder.isSelected = (!isImageObject(el) && el.id === folder.id);
    return folder;
  });

  imageModels.value.map(function (image) {
    image.isSelected = (isImageObject(el) && el.id === image.id);
    return image;
  });

  selectedFolder.value = folderModels.value.filter(folder => !isImageObject(el) && el.id === folder.id)[0];
  selectedImage.value = imageModels.value.filter(image => isImageObject(el) && el.id === image.id)[0];
}

function clearSelections() {
  folderModels.value.map(function (folder) {
    folder.isSelected = false;
    return folder;
  });

  imageModels.value.map(function (image) {
    image.isSelected = false;
    return image;
  });

  selectedFolder.value = null;
  selectedImage.value = null;
}

function isImageObject(el) {
  return 'uri' in el;
}
</script>
<style lang="scss">
.folder-base.selected, .image-base.selected {
  .icon-base {
    background-color: rgb(229 231 235);

    &:hover {
      background-color: rgb(221, 223, 227);
    }
  }
}
</style>