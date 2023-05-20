<template>
  <FileTopBar
    :selected-file="selectedFile"
    @clear-selections="clearSelections"
  />
  <div
    class="grid gap-2 grid-cols-2 md:grid-cols-6 xl:grid-cols-8 mt-12"
    @click.self="clearSelections"
  >
    <FileCreate />
    <template
      v-for="file in fileModels"
      :key="file.id"
    >
      <FileBase
        :file="file"
        @click="selectFile(file)"
        @dblclick="alert('copied')"
      />
    </template>
  </div>
  <PaginationSimple
    :links="files.links"
  />
</template>

<script setup>
import FileCreate from "./FileCreate.vue";
import FileBase from "./FileBase.vue";
import FileModel from "../Models/File";
import FileTopBar from "../Shared/FileTopBar.vue";
import PaginationSimple from "./PaginationSimple.vue";
import { ref, watch } from "vue";

const props = defineProps({
  files: {
    type: Object,
    default: () => {}
  },
});
const fileModels = ref(props.files.data.map(file => new FileModel(file)));
const selectedFile = ref(null);

watch(props, (newProps) => {
  fileModels.value = newProps.files.data.map(file => new FileModel(file));
});

function selectFile(el) {
  fileModels.value.map(function (file) {
    file.isSelected = (el.id === file.id);
    return file;
  });

  selectedFile.value = fileModels.value.filter(file => el.id === file.id)[0];
}

function clearSelections() {
  fileModels.value.map(function (file) {
    file.isSelected = false;
    return file;
  });

  selectedFile.value = null;
}
</script>
<style lang="scss">
.file-base.selected {
  .icon-base {
    background-color: rgb(229 231 235);

    &:hover {
      background-color: rgb(221, 223, 227);
    }
  }
}
</style>