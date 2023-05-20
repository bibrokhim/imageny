<template>
  <Head :title="$page.props.shared.appName" />
  <div class="mt-20 flex content-center justify-center">
    <slot />
  </div>
</template>

<script setup>
import { Head } from '@inertiajs/vue3'
</script>

<style scoped>

</style>