<script setup lang="ts">
let layout = "default";
const route = useRoute();
if (route.path.startsWith('/admin'))  layout = "admin";
</script>

<template>
  <NuxtLayout :name="layout">
    <NuxtPage page-key="static" />
  </NuxtLayout>
</template>