<template>
  <div
    class="image-base"
    :class="{'selected': image.isSelected}"
  >
    <IconBase
      :title="image.name"
      :image-src="image.uri"
    />
  </div>
</template>

<script setup>
import IconBase from "./IconBase.vue";
import Image from "../Models/Image";

const props = defineProps({
  image: {
    type: Image,
    required: true
  }
});
</script>