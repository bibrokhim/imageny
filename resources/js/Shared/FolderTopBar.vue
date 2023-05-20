<template>
  <div class="folder-top-bar  fixed w-full top-0 left-0 bg-transparent">
    <div class="flex flex-row">
      <div class="relative md:w-1/4" />
      <div class="w-full md:w-3/4 flex flex-row justify-between py-6 px-10 bg-gray-100">
        <Breadcrumbs :breadcrumbs="breadcrumbs" />
        <FolderTopBarSelectedFolder
          v-if="selectedFolder"
          :selected-folder="selectedFolder"
          @clear-selections="$emit('clearSelections')"
        />
        <FolderTopBarSelectedImage
          v-if="selectedImage"
          :selected-image="selectedImage"
          @clear-selections="$emit('clearSelections')"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import Folder from "../Models/Folder";
import Image from "../Models/Image";
import Breadcrumbs from "./FolderTopBarBreadcrumbs.vue";
import FolderTopBarSelectedFolder from "./FolderTopBarSelectedFolder.vue";
import FolderTopBarSelectedImage from "./FolderTopBarSelectedImage.vue";

const props = defineProps({
  breadcrumbs: {
    type: Array,
    default: () => []
  },
  selectedFolder: {
    type: Folder,
    default: null
  },
  selectedImage: {
    type: Image,
    default: null
  }
});
defineEmits(['clearSelections']);
</script>
