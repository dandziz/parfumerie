<script setup lang="ts">
import type { MaybeRef } from 'vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';

let layout = ref<MaybeRef>("default");
const route = useRoute();
if (route.path.startsWith('/admin'))  layout.value = "admin";
</script>

<template>
  <NuxtLayout :name="layout">
    <NuxtPage page-key="static" />
  </NuxtLayout>
</template>

<style lang="scss">
@import "~/assets/abstracts/_mixins.scss"
</style>
