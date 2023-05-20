<template>
  <Head :title="'Images | ' + imageModel.name + '.' + imageModel.extension" />
  <FolderTopBar
    :breadcrumbs="breadcrumbs"
    :selected-image="imageModel"
  />
  <div class="flex flex-row justify-center mt-16 mb-4">
    <ButtonBase
      v-for="(formattedSizes, format) in imageModel.formats"
      :key="format"
      :type="format === selectedExtension ? 'yellow' : 'default'"
      class="ml-2"
      @click="selectedExtension = format"
    >
      {{ format.toUpperCase() }}
    </ButtonBase>
  </div>
  <div class="flex flex-col md:flex-row">
    <div class="w-full p-2">
      <img
        :src="imageModel.sizes.large.uri"
        :alt="imageModel.name"
        class="rounded mx-auto"
      >
    </div>
    <div class="w-full p-2">
      <template
        v-for="(formattedSizes, format) in imageModel.formats"
        :key="format"
      >
        <ImageShowSizes
          v-if="format === selectedExtension"
          :sizes="formattedSizes"
        />
      </template>
    </div>
  </div>
</template>

<script setup>
import Image from "../Models/Image";
import ImageShowSizes from "../Shared/ImageShowSizes.vue";
import ButtonBase from "../Shared/ButtonBase.vue";
import FolderTopBar from "../Shared/FolderTopBar.vue";
import { Head } from '@inertiajs/vue3'
import { ref } from "vue";

const props = defineProps({
  image: {
    type: Object,
    required: true
  },
  breadcrumbs: {
    type: Array,
    required: true
  },
});
defineEmits(['closeModal']);
const imageModel = ref(new Image(props.image.data));
const selectedExtension = ref(imageModel.value.extension);
</script>

