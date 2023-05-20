<template>
  <ModalBase
    v-if="show"
    title="Rename file"
    :card-class="'max-w-md mt-20'"
    @close-modal="closeModal"
  >
    <InputBase
      v-model="form.name"
      class="my-6"
      :focus="true"
      :error-text="form.errors.name"
      @keyup.enter="updateFile"
    />
    <div class="mt-3">
      <ButtonBase
        class="float-right"
        type="yellow"
        :disabled="form.name.length === 0 || form.processing"
        @click="updateFile"
      >
        Update
      </ButtonBase>
    </div>
  </ModalBase>
</template>

<script setup>
import File from "../Models/File";
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
  file: {
    type: File,
    required: true
  }
});
const emit = defineEmits(['closeModal', 'clearSelections']);
const form = useForm({
  name: props.file.name,
  _method: 'PUT',
});

watch(props, (newProps) => form.name = newProps.file.name)

function closeModal() {
  emit('closeModal');
}

function updateFile() {
  form
      .post(route('files.update', props.file.id), {
        onSuccess: function () {
          form.name = '';
          closeModal();
          emit('clearSelections');
        },
        preserveScroll: true,
      });
}
</script>