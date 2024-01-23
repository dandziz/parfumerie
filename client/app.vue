<script setup lang="ts">
import type { MaybeRef } from 'vue';

let layout = ref<MaybeRef>("default");
const route = useRoute();
if (route.path.startsWith('/admin'))  layout.value = "admin";
</script>

<template>
  <NuxtLayout :name="layout">
    <NuxtPage page-key="static" />
  </NuxtLayout>
</template>
