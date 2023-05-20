<template>
  <Head :title="'Images / ' + folder.data.name" />
  <FoldersGrid
    :folders="folder.data.children"
    :images="images"
    :breadcrumbs="breadcrumbs"
    :current-folder="folder.data"
  />
</template>

<script setup>
import FoldersGrid from "../Shared/FoldersGrid.vue";
import { Head } from '@inertiajs/vue3'

const props = defineProps({
  folder: {
    type: Object,
    default: () => {}
  },
  images: {
    type: Object,
    default: () => {}
  },
  breadcrumbs: {
    type: Array,
    required: true
  },
})
</script>