<template>
  <div v-if="selectedImage">
    <ButtonSmall
      class="ml-4 bg-gray-50 hover:bg-gray-200"
      @click="showImageEditModal = true"
    >
      <vue-feather
        type="edit"
        size="16"
        class="translate-y-0.5"
      />
      Rename
    </ButtonSmall>
    <ButtonSmall
      class="ml-4 bg-gray-50 hover:bg-gray-200 hover:text-red-700"
      @click="deleteImage"
    >
      <vue-feather
        type="trash"
        size="16"
        class="translate-y-0.5"
      />
      Delete
    </ButtonSmall>
  </div>
  <ImageEditModal
    v-if="selectedImage"
    :image="selectedImage"
    :show="showImageEditModal"
    @close-modal="showImageEditModal = false"
    @clear-selections="$emit('clearSelections')"
  />
</template>

<script setup>
import Image from "../Models/Image";
import ButtonSmall from "./ButtonSmall.vue";
import ImageEditModal from "./ImageEditModal.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  selectedImage: {
    type: Image,
    required: true
  },
});
const emit = defineEmits(['clearSelections']);
const showImageEditModal = ref(false);

function deleteImage() {
  router.post(route('images.destroy', props.selectedImage.id), {
    '_method': 'DELETE'
  }, {preserveScroll: true});
  emit('clearSelections');
}
</script>
