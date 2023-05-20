<template>
  <form @submit.prevent="submit">
    <label for="files">
      <IconBase
        title="File upload"
        :image-src="imageSrc"
        image-alt="File upload"
      />
    </label>
    <input
      id="files"
      type="file"
      class="hidden"
      accept=".pdf, .mp4"
      multiple
      @input="form.files = $event.target.files"
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

const imageSrc = new URL('../assets/file-add-96.png', import.meta.url).href;
const form = useForm({
  files: null
});

function submit() {
  form.post(route('files.upload'));
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