<template>
  <button
    type="button"
    class="py-2 px-4 transition ease-in duration-200 text-center
      text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2
      rounded-lg disabled:bg-gray-200 disabled:text-gray-400"
    :class="colors[type]"
  >
    <slot />
  </button>
</template>

<script setup>
const props = defineProps({
  type: {
    type: String,
    default: 'default'
  }
});
const colors = {
  default: '',
  yellow: 'bg-yellow-400 hover:bg-yellow-500 focus:ring-yellow-500 focus:ring-offset-yellow-200 text-black',

};
</script>