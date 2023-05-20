<template>
  <div
    class="folder-base"
    :class="{'selected': folder.isSelected}"
  >
    <IconBase
      :title="folder.name"
      :image-src="imageSrc"
      :image-alt="folder.alt"
    />
  </div>
</template>

<script setup>
import IconBase from "./IconBase.vue";
import Folder from "../Models/Folder";

const props = defineProps({
  folder: {
    type: Folder,
    required: true
  },
  alt: {
    type: String,
    default: 'Empty folder icon'
  },
  icon: {
    type: String,
    default: 'folder-96.png'
  }
});
const imageSrc = new URL('../assets/folder-96.png', import.meta.url).href;
</script>