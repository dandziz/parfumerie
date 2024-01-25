<template>
  <div class="container-fluid breadcrumb-wrap pt-2 pb-2 mb-2">
    <div class="container p-0">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb m-0">
          <li
            class="breadcrumb-item"
            v-for="(item, index) in breadcrumbs"
            :key="index"
          >
            <component
              :is="renderedComponent(item.active)"
              class="text-decoration-none p-14"
              :class="{ 'text-dark': !item.active, 'text-gray opacity-75': item.active }"
              :to="item.to"
              >{{ item.name }}</component
            >
          </li>
        </ol>
      </nav>
    </div>
  </div>
</template>

<script lang="ts">
import { type Breadcrumb } from "@types";
export default {
  setup() {
    return {};
  },
  props: {
    breadcrumbs: {
      type: Array<Breadcrumb>,
      require: true,
    },
  },
  methods: {
    renderedComponent(active: boolean)  {
      if (active) {
        return "span";
      } else {
        return defineNuxtLink({});
      }
    },
  },
};
</script>

<style lang="scss">
.breadcrumb-wrap {
  background-color: #f9f9f9;
}
</style>
