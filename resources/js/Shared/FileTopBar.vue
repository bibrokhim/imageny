<template>
  <div class="folder-top-bar  fixed w-full top-0 left-0 bg-transparent">
    <div class="flex flex-row">
      <div class="relative md:w-1/4" />
      <div class="w-full md:w-3/4 flex flex-row justify-between py-6 px-10 bg-gray-100">
        <p>Files</p>
        <FileTopBarSelectedFile
          v-if="selectedFile"
          :selected-file="selectedFile"
          @clear-selections="$emit('clearSelections')"
        />
      </div>
    </div>
  </div>
</template>

<script setup>
import FileTopBarSelectedFile from "./FileTopBarSelectedFile.vue";
import File from "../Models/File";

const props = defineProps({
  selectedFile: {
    type: File,
    default: null
  },
});
defineEmits(['clearSelections']);
</script>
