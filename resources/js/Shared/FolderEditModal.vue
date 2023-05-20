<template>
  <ModalBase
    v-if="show"
    title="Rename folder"
    :card-class="'max-w-md mt-20'"
    @close-modal="closeModal"
  >
    <InputBase
      v-model="form.name"
      class="my-6"
      :focus="true"
      :error-text="form.errors.name"
      @keyup.enter="updateFolder"
    />
    <div class="mt-3">
      <ButtonBase
        class="float-right"
        type="yellow"
        :disabled="form.name.length === 0 || form.processing"
        @click="updateFolder"
      >
        Update
      </ButtonBase>
    </div>
  </ModalBase>
</template>

<script setup>
import Folder from "../Models/Folder";
import ModalBase from "../Shared/ModalBase.vue";
import InputBase from "../Shared/InputBase.vue";
import ButtonBase from "../Shared/ButtonBase.vue";
import { useForm } from "@inertiajs/vue3";
import { watch } from "vue";

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  folder: {
    type: Folder,
    required: true
  }
});
const emit = defineEmits(['closeModal', 'clearSelections']);
const form = useForm({
  name: props.folder.name,
  folder_id: props.folder.id,
  _method: 'PUT',
});

watch(props, (newProps) => form.name = newProps.folder.name)

function closeModal() {
  emit('closeModal');
}

function updateFolder() {
  form
      .post(route('folders.update', props.folder.id), {
        onSuccess: function () {
          form.name = '';
          closeModal();
          emit('clearSelections');
        },
        preserveScroll: true,
      });
}
</script>