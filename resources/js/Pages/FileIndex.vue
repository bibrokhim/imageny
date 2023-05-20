<template>
  <Head title="Files" />
  <FilesGrid
    :files="files"
  />
</template>

<script setup>
import FilesGrid from "../Shared/FilesGrid.vue";
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  files: {
    type: Object,
    default: () => {}
  },
})
</script>