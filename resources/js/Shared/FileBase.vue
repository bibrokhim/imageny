<template>
  <div
    class="file-base"
    :class="{'selected': file.isSelected}"
  >
    <IconBase
      :title="file.name"
      :image-src="imageSrc"
    />
  </div>
</template>

<script setup>
import IconBase from "./IconBase.vue";
import File from "../Models/File";

const props = defineProps({
  file: {
    type: File,
    required: true
  }
});
let imageSrc =  new URL('../assets/file-96.png', import.meta.url).href;

switch (props.file.extension) {
  case 'pdf':
    imageSrc = new URL('../assets/file-pdf-96.png', import.meta.url).href;
    break;

  case 'mp4':
    imageSrc = new URL('../assets/file-video-96.png', import.meta.url).href;
    break;
}
</script>