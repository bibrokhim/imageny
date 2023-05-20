<template>
  <div class="relative">
    <label
      v-if="label.length > 0"
      class="text-gray-700"
      v-text="label"
    />
    <input
      ref="input"
      :type="type"
      class="rounded-lg flex-1 appearance-none border border-gray-400 w-full
        py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base
        focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent"
      :placeholder="placeholder"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
    >
    <span
      v-if="errorText.length > 0"
      class="text-red-500"
      v-text="errorText"
    />
  </div>
</template>
<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
  label: {
    type: String,
    default: ''
  },
  placeholder: {
    type: String,
    default: ''
  },
  type: {
    type: String,
    default: 'text'
  },
  modelValue: {
    type: String,
    default: ''
  },
  errorText: {
    type: String,
    default: ''
  },
  focus: {
    type: Boolean,
    default: false
  }
});
defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
  props.focus ? input.value.focus() : ''
});
</script>