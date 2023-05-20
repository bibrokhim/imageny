<template>
  <div class="container flex flex-col mx-auto w-full items-center justify-center">
    <ul class="flex flex-col">
      <li
        v-for="(params, sizeName) in sizes"
        :key="sizeName"
        class="border-gray-400 flex flex-row mb-2"
      >
        <ImageShowSizeCard
          :size-name="sizeName"
          :image-params="params"
        />
      </li>
    </ul>
  </div>
</template>

<script setup>
import ImageShowSizeCard from "./ImageShowSizeCard.vue";

const props = defineProps({
  sizes: {
    type: Object,
    required: true
  }
});
</script>