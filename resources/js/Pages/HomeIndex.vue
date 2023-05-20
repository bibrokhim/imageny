<template>
  <Header title="Dashboard" />
  <div class="flex flex-row max-w-lg mt-10">
    <CardCount
      title="Number of images"
      :value="imagesCount.toString()"
      class="mr-4"
    />
    <CardCount
      title="Total size of original images"
      :value="imagesSize"
    />
  </div>
</template>

<script setup>
import Header from '../Shared/TheHeader.vue';
import CardCount from "../Shared/CardCount.vue";

const props = defineProps({
  imagesCount: {
    type: Number,
    required: true
  },
  imagesSize: {
    type: String,
    required: true
  }
});
</script>
