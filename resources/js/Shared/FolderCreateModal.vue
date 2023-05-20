<template>
  <ModalBase
    v-if="show"
    title="New folder"
    :card-class="'max-w-md mt-20'"
    @close-modal="closeModal"
  >
    <InputBase
      v-model="form.name"
      class="my-6"
      :focus="true"
      :error-text="form.errors.name"
      @keyup.enter="addFolder"
    />
    <div class="mt-3">
      <ButtonBase
        class="float-right"
        type="yellow"
        :disabled="form.name.length === 0 || form.processing"
        @click="addFolder"
      >
        Save
      </ButtonBase>
    </div>
  </ModalBase>
</template>

<script setup>
import ModalBase from "../Shared/ModalBase.vue";
import InputBase from "../Shared/InputBase.vue";
import ButtonBase from "../Shared/ButtonBase.vue";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
  show: {
    type: Boolean,
    default: false
  },
  currentFolder: {
    type: Object,
    required: true
  }
});
const emit = defineEmits(['closeModal']);
const form = useForm({
  name: '',
  parent_id: props.currentFolder?.id
});

function closeModal() {
  emit('closeModal');
}

function addFolder() {
  form
      .transform((data) => ({
        ...data,
        parent_id: props.currentFolder?.id
      }))
      .post(route('folders.store'), {
        onSuccess: function () {
          form.name = '';
          closeModal();
        },
        preserveScroll: true,
      });
}
</script>