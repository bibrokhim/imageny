<template>
  <Head title="Images" />
  <FoldersGrid
    :folders="folders.data"
  />
</template>

<script setup>
import FoldersGrid from "../Shared/FoldersGrid.vue";
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  folders: {
    type: Object,
    default: () => {}
  },
})
</script>