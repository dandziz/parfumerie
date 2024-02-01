<template>
  <v-breadcrumbs class="m-0" :items="items"> </v-breadcrumbs>
</template>

<script lang="ts">
import { type AdminBreadcrumb } from "@types";
import type { RouteLocationNormalizedLoaded } from "vue-router";
export default {
  setup() {
    const route = useRoute();
    const items = ref<Array<AdminBreadcrumb>>([]);
    const convertBreadcrumb = (route: RouteLocationNormalizedLoaded, items: Array<AdminBreadcrumb>) => {
      const name = route.name?.toString().split("-") ?? [];
      const nameLength = name?.length ?? 0;
      for (let i = 0; i < nameLength; i++) {
        let link = "";
        for (let j = 0; j <= i; j++) {
          if (j == i) link += name[j];
          else link += name[j] + "-";
        }
        const child = {
          title: name[i].charAt(0).toUpperCase() + name[i].slice(1),
          disabled: false,
          to: { name: link },
        };
        if (i == nameLength - 1) child.disabled = true;
        if (child.title == 'Admin') child.title = 'Dashboard'

        if (child.title == 'Id') child.title = route?.params?.id?.toString() ?? 'Id'

        items.push({...child});
      }
    }
    convertBreadcrumb(route, items.value)
    return { items, convertBreadcrumb }
  },
  watch: {
    $route(to) {
      this.items = []
      this.convertBreadcrumb(to, this.items)
    },
  },
};
</script>
