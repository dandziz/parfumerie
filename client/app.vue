<script setup lang="ts">
import type { MaybeRef } from 'vue';
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import { useStore } from 'vuex'
import axios from '@axios';
import type { Response } from '@types';
import type { Brand } from './models'
import type { AxiosResponse } from 'axios';
const store = useStore()

let layout = ref<MaybeRef>("default");
const route = useRoute();
if (route.path.startsWith('/admin'))  layout.value = "admin";

axios.get('brands').then((response: AxiosResponse<Response<Brand>>) => {
  store.dispatch('brand/setBrands', response.data.data);
})
</script>

<template>
  <NuxtLayout :name="layout">
    <NuxtPage page-key="static" />
  </NuxtLayout>
</template>

<style lang="scss">
@import "~/assets/abstracts/_mixins.scss"
</style>
