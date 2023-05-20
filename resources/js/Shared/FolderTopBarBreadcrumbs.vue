<template>
  <div class="breadcrumbs text-sm pt-1 text-gray-600 ml-4">
    <Link
      :href="route('folders.index')"
      :class="{'font-semibold': route().current() !== 'folders.index'}"
    >
      Images
    </Link>
    <template
      v-for="(breadcrumb, index) in breadcrumbs"
      :key="index"
    >
      <vue-feather
        type="chevron-right"
        class="mx-2 translate-y-0.5"
        size="16"
      />
      <Link
        v-if="breadcrumb.link"
        :href="breadcrumb.link"
        class="font-semibold"
      >
        {{ breadcrumb.title }}
      </Link>
      <span
        v-else
        v-text="breadcrumb.title"
      />
    </template>
  </div>
</template>

<script setup>
import { Link } from "@inertiajs/vue3";


const props = defineProps({
  breadcrumbs: {
    type: Array,
    required: true
  },
});
</script>
