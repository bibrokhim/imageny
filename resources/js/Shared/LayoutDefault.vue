<template>
  <Head :title="$page.props.shared.appName" />
  <div class="flex flex-row">
    <div class="relative md:w-1/4">
      <TheSidebar />
    </div>
    <main
      role="main"
      class="w-full md:w-3/4 pt-9 px-9"
    >
      <FlashMessage />
      <slot />
    </main>
  </div>
</template>

<script setup>
import TheSidebar from "../Shared/TheSidebar.vue";
import FlashMessage from "./FlashMessage.vue";
import { Head } from '@inertiajs/vue3'
</script>
