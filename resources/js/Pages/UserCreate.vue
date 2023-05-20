<template>
  <Header :title="props.user ? 'Edit user' : 'New user'" />
  <div class="relative overflow-x-auto max-w-md">
    <InputBase
      v-model="form.name"
      class="my-6"
      placeholder="Name"
      label="Name"
      :focus="true"
      :error-text="form.errors.name"
    />
    <InputBase
      v-model="form.email"
      class="my-6"
      placeholder="Email"
      label="Email"
      :error-text="form.errors.email"
    />
    <InputBase
      v-model="form.password"
      class="my-6"
      placeholder="Password"
      label="Password"
      type="password"
      :error-text="form.errors.password"
    />
    <ButtonBase
      class="mb-4"
      type="yellow"
      :disabled="form.processing"
      @click="props.user ? updateUser() : saveUser()"
    >
      {{ props.user ? 'Update' : 'Save' }}
    </ButtonBase>
  </div>
</template>

<script setup>
import Header from '../Shared/TheHeader.vue';
import InputBase from "../Shared/InputBase.vue";
import { useForm } from "@inertiajs/vue3";
import ButtonBase from "../Shared/ButtonBase.vue";

const props = defineProps({
  user: {
    type: Object,
    default: () => {}
  }
})

const form = useForm({
  name: props.user?.name,
  email: props.user?.email,
  password: '',
  _method: 'POST'
});

function saveUser() {
  form.post(route('users.store'));
}

function updateUser() {
  form._method = 'PUT';
  form
    .post(route('users.update', props.user.id));
}

</script>
