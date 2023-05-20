<template>
  <div class="shadow border select-none bg-white rounded-md flex flex-1 items-center p-4">
    <div
      class="p-4 rounded mr-2"
      :class="imageParams.extension"
      v-text="imageParams.extension.toUpperCase()"
    />
    <div class="flex-1 pl-1 md:mr-16">
      <div
        class="font-medium"
        v-text="sizeName"
      />
      <div
        class="text-gray-600 text-sm"
        v-text="imageParams.resolution[0] + 'x' + imageParams.resolution[1]"
      />
    </div>
    <div
      class="text-gray-600 text-xs"
      v-text="imageParams.size"
    />
    <button
      class="w-24 text-right flex justify-end"
      @click="copyLinkToClipboard(imageParams.uri, sizeName)"
    >
      <vue-feather
        v-if="sizeName === copiedSizeName"
        type="check"
        class="text-green-700"
      />
      <vue-feather
        v-else
        type="copy"
      />
    </button>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useClipboard } from "../Composables/clipboard";

const props = defineProps({
  sizeName: {
    type: String,
    required: true
  },
  imageParams: {
    type: Object,
    required: true
  }
});

const copiedSizeName = ref('');

function copyLinkToClipboard(link, sizeName) {
  useClipboard(link);
  copiedSizeName.value = sizeName;
  setTimeout(() => copiedSizeName.value = '', 3000);
}
</script>

<style lang="scss" scoped>
.jpg {
  background-color: #fef08a;
}

.png {
  background-color: #bae6fd;
}

.webp {
  background-color: #a7f3d0;
}
</style>