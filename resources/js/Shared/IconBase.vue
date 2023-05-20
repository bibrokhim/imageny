<template>
  <div class="icon-base p-4 cursor-pointer flex flex-col justify-start rounded">
    <div class="h-16 mx-auto mb-1">
      <img
        :src="imageSrc"
        :alt="imageAlt"
        class="rounded max-h-full"
      >
    </div>
    <p
      class="text-gray-600 text-center text-sm"
      v-text="titleExcerpt"
    />
  </div>
</template>

<script setup>
import {computed} from "vue";

const props = defineProps({
  imageSrc: {
    type: String,
    required: true
  },
  title: {
    type: String,
    required: true
  },
  imageAlt: {
    type: String,
    default: ''
  }
});
const titleExcerpt = computed(
    () =>
      props.title.length > 20 ? props.title.substring(0, 20) + '...' : props.title
)
</script>

<style lang="scss" scoped>
.icon-base {
  &:hover {
    background-color: rgb(229 231 235);
  }
}
</style>