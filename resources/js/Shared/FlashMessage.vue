<template>
  <div
    v-show="show"
    class="fixed top-10 left-0 w-full flex flex-row justify-end z-20 alert"
    role="alert"
  >
    <div
      class="w-1/4 mx-4 px-4 py-3 bg-red border rounded relative"
      :class="$page.props.flash.message_type ?? 'danger'"
    >
      <p class="font-bold">
        {{ $page.props.flash.message_title ?? 'Error' }}
      </p>
      <span class="block sm:inline">{{ $page.props.flash.message }}</span>
      <span class="absolute top-0 bottom-0 right-0 px-4 py-3" />
      <vue-feather
        type="x"
        class="ml-3 absolute top-1.5 right-1.5 cursor-pointer"
        @click="show = false"
      />
      <div
        ref="progress"
        class="progress"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, watch} from "vue";
import { usePage } from "@inertiajs/vue3";

const show = ref(!! usePage().props.flash?.message);
const progress = ref();

watch(usePage().props, function (newProps) {
  show.value = !! newProps.flash?.message

  if (show.value) {
    setTimeout(function() {
      show.value = false;
      progress.value.classList.remove('shown');
    }, 3000);
    setTimeout(() => progress.value.classList.add('shown'), 30);
  }
});
</script>

<style lang="scss" scoped>
  .alert {
    .progress {
      height: 5px;
      width: 100%;
      background-color: #fff;
      position: absolute;
      left: -1px;
      bottom: -1px;
      border: 1px solid #fff;
      transition: all linear 3s;
    }

    .shown {
      width: 0;
    }

    .danger {
      color: rgb(255 255 255);
      background-color: rgb(185 28 28);
      border-color: rgb(248 113 113);
    }
  }
</style>