<template>
  <div class="flex flex-col w-full px-4 py-6 bg-white rounded-lg shadow sm:px-6 md:px-8">
    <p
      v-if="title.length > 0"
      class="font-bold text-md text-black mb-5"
      v-text="title"
    />
    <slot />
  </div>
</template>

<script setup>
const props = defineProps({
  title: {
    type: String,
    default: ''
  }
})
</script>
