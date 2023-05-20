<template>
  <div>
    <span v-text="selectedFolder.name" />
    <ButtonSmall
      class="ml-4 bg-gray-50 hover:bg-gray-200"
      @click="showFolderEditModal = true"
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
      @click="deleteFolder"
    >
      <vue-feather
        type="trash"
        size="16"
        class="translate-y-0.5"
      />
      Delete
    </ButtonSmall>
  </div>
  <FolderEditModal
    v-if="selectedFolder"
    :folder="selectedFolder"
    :show="showFolderEditModal"
    @close-modal="showFolderEditModal = false"
    @clear-selections="$emit('clearSelections')"
  />
</template>

<script setup>
import Folder from "../Models/Folder";
import ButtonSmall from "./ButtonSmall.vue";
import FolderEditModal from "./FolderEditModal.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  selectedFolder: {
    type: Folder,
    required: true
  },
});
const emit = defineEmits(['clearSelections']);
const showFolderEditModal = ref(false);

function deleteFolder() {
  router.post(route('folders.destroy', props.selectedFolder.id), {
    '_method': 'DELETE'
  }, {preserveScroll: true});
  emit('clearSelections');
}
</script>
