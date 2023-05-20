<template>
  <div v-if="selectedFile">
    <ButtonSmall
      class="ml-4 bg-gray-50 hover:bg-gray-200"
      @click="showFileEditModal = true"
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
      @click="deleteFile"
    >
      <vue-feather
        type="trash"
        size="16"
        class="translate-y-0.5"
      />
      Delete
    </ButtonSmall>
    <ButtonSmall
      class="ml-4 bg-gray-50 hover:bg-gray-200"
      @click="copyFileUriToClipboard"
    >
      <vue-feather
        v-if="copied"
        type="check"
        size="16"
        class="text-green-700 copy-icon"
      />
      <vue-feather
        v-else
        size="16"
        type="copy"
        class="copy-icon"
      />
      Copy url
    </ButtonSmall>
  </div>
  <FileEditModal
    v-if="selectedFile"
    :file="selectedFile"
    :show="showFileEditModal"
    @close-modal="showFileEditModal = false"
    @clear-selections="$emit('clearSelections')"
  />
</template>

<script setup>
import File from "../Models/File";
import ButtonSmall from "./ButtonSmall.vue";
import FileEditModal from "./FileEditModal.vue";
import { ref } from "vue";
import { router } from "@inertiajs/vue3";
import { useClipboard } from "../Composables/clipboard";

const props = defineProps({
  selectedFile: {
    type: File,
    required: true
  },
});
const emit = defineEmits(['clearSelections']);
const showFileEditModal = ref(false);
const copied = ref(false);

function deleteFile() {
  router.post(route('files.destroy', props.selectedFile.id), {
    '_method': 'DELETE'
  }, {preserveScroll: true});
  emit('clearSelections');
}

function copyFileUriToClipboard() {
  useClipboard(props.selectedFile.uri);
  copied.value = true;
}
</script>

<style scoped>
.copy-icon {
    vertical-align: middle;
}
</style>
