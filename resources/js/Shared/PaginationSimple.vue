<template>
  <div class="pagination my-6 float-right">
    <Link
      v-if="links.prev"
      :href="links.prev"
    >
      <ButtonBase
        type="yellow"
        class="mr-3"
      >
        <vue-feather
          type="arrow-left"
          class="translate-y-0.5"
          size="16"
        />
        Prev
      </ButtonBase>
    </Link>
    <Link
      v-if="links.next"
      :href="links.next"
    >
      <ButtonBase
        type="yellow"
      >
        Next
        <vue-feather
          type="arrow-right"
          class="translate-y-0.5"
          size="16"
        />
      </ButtonBase>
    </Link>
  </div>
</template>

<script setup>
import ButtonBase from "./ButtonBase.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  links: {
    type: Object,
    required: true
  }
});
</script>

<style scoped>

</style>