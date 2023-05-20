<template>
  <Head :title="title" />
  <header class="mb-4">
    <h1
      class="text-xl"
      v-text="title"
    />
  </header>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
const props = defineProps({
  title: {
    type: String,
    required: true
  }
});
</script>