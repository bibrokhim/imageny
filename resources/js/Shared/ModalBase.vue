<template>
  <div class="modal-wrapper">
    <div 
      class="modal flex justify-center align-middle"
    >
      <CardBase
        v-click-outside="() => $emit('closeModal')"
        :title="title"
        :class="cardClass"
        class="relative"
        @keyup.esc="$emit('closeModal')"
      >
        <vue-feather
          type="x"
          class="ml-3 absolute top-4 right-4 cursor-pointer"
          @click="$emit('closeModal')"
        />
        <slot />
      </CardBase>
    </div>
  </div>
</template>

<script setup>
import CardBase from "./CardBase.vue";

defineEmits(['closeModal']);
const props = defineProps({
  title: {
    type: String,
    required: true
  },
  cardClass: {
    type: String,
    default: ''
  }
});
</script>

<style lang="scss" scoped>
.modal-wrapper {
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .2);
  position: fixed;
  top: 0;
  left: 0;
  z-index: 10000;
}

</style>