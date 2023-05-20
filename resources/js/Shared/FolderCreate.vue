<template>
  <IconBase
    title="New folder"
    :image-src="imageSrc"
    @click="showModal = true"
  />
  <FolderCreateModal
    :current-folder="currentFolder"
    :show="showModal"
    @close-modal="showModal = false"
  />
</template>

<script setup>
import FolderCreateModal from "../Shared/FolderCreateModal.vue";
import {ref} from "vue";
import IconBase from "./IconBase.vue";

const props = defineProps({
  currentFolder: {
    type: Object,
    required: true
  }
});
const showModal = ref(false);
const imageSrc = new URL('../assets/plus-96.png', import.meta.url).href;
</script>
