<script setup lang="ts">
import { type MaybeRef } from "vue";
import { ref } from "vue";
import { useRoute, useRouter } from "vue-router";
import { useStore } from "vuex";
import axios from "@axios";
import type { RESPONSE_API_SUCCESS } from "@types";
import { type Brand } from "./models";
import type { AxiosResponse } from "axios";
import NProgress from "nprogress";
import { importUserInformation } from "./utils/useStore";
NProgress.configure({ showSpinner: false });
import { useAbility } from "@casl/vue";

const store = useStore();

let layout = ref<MaybeRef>("admin");
layout.value = "default";
const route = useRoute();
const router = useRouter();
if (route.path.startsWith("/admin")) layout.value = "admin";

axios.get("brands").then((response: AxiosResponse<RESPONSE_API_SUCCESS<Brand>>) => {
  store.dispatch("brand/setBrands", response.data.data);
});
importUserInformation()
watch(
  () => route.name,
  () => {
    if (route.path.startsWith("/admin")) layout.value = "admin";
    else layout.value = "default";
  }
);
router.beforeResolve((to, from, next) => {
  if (to.name) {
    NProgress.start();
  }
  next();
});
router.afterEach(() => {
  NProgress.done();
});
</script>

<template>
  <NuxtLoadingIndicator />
  <NuxtLayout :name="layout">
    <NuxtPage page-key="static" />
  </NuxtLayout>
  <Notification />
</template>

<style lang="scss">
@import "~/assets/abstracts/_mixins.scss";
.page-enter-active,
.page-leave-active {
  transition: all 0.4s;
}
.page-enter-from,
.page-leave-to {
  opacity: 0.8;
  filter: blur(0);
}
</style>
