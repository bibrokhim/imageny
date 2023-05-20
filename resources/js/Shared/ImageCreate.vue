<template>
  <form @submit.prevent="submit">
    <label for="images">
      <IconBase
        title="Image upload"
        :image-src="imageSrc"
        image-alt="Image upload"
      />
    </label>
    <input
      id="images"
      type="file"
      class="hidden"
      accept="image/png, image/jpeg"
      multiple
      @input="form.images = $event.target.files"
      @change="submit"
    >
    <progress
      v-if="form.progress"
      :value="form.progress.percentage"
      max="100"
      class="max-w-full h-2 rounded"
    >
      {{ form.progress.percentage }}%
    </progress>
  </form>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import IconBase from "./IconBase.vue";

const imageSrc = new URL('../assets/image-add-96.png', import.meta.url).href;
const props = defineProps({
  currentFolder: {
    type: Object,
    required: true
  }
});
const form = useForm({
  images: null
});

function submit() {
  form.post(route('images.upload', props.currentFolder.id));
}
</script>

<style lang="scss" scoped>
progress {
  &::-webkit-progress-bar {
    background-color: #cbd5e0;
    border-radius: 10px;
  }
  &::-webkit-progress-value {
    background-color: rgb(21 128 61);
    border-radius: 10px;
  }
}
</style>