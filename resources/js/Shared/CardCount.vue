<template>
  <div class="shadow-lg w-full rounded-2xl p-4 bg-white">
    <div class="flex items-center">
      <p class="text-md text-gray-700 ml-2">
        {{ title }}
      </p>
    </div>
    <div class="flex flex-col justify-start">
      <p class="text-gray-800 text-4xl text-left font-bold my-4">
        {{ value }}
      </p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  title: {
    type: String,
    required: true
  },
  value: {
    type: String,
    required: true
  }
});
</script>

<style scoped>

</style>