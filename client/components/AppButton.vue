<template>
  <component
    class="btn cursor-pointer"
    :class="{
      'd-flex align-items-center gap-2': componentType == 'button',
      [bg]: bg && !bgNone,
      'rounded-0': !borderRadius,
      'rounded-sm': borderRadius,
      'bg-none': bgNone,
      'text-white': !bgNone,
    }"
    :to="to"
    :is="renderedComponent"
    :disabled="loading"
    :type="type"
  >
    <slot></slot>
    <VProgressCircular
      indeterminate
      color="white"
      :width="2"
      :size="20"
      v-if="loading"
    />
  </component>
</template>
<script lang="ts">
import { bg } from "vuetify/lib/locale/index.mjs";

export default {
  props: {
    componentType: {
      type: String,
      default: "button",
    },
    bg: {
      type: String,
      default: "btn-success",
    },
    borderRadius: {
      type: Boolean,
      default: true,
    },
    to: {
      type: String,
      default: "",
    },
    bgNone: {
      type: Boolean,
      default: false,
    },
    loading: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    renderedComponent() {
      if (this.componentType === "button") {
        return "button";
      } else if (this.componentType === "link") {
        return defineNuxtLink({});
      } else {
        return "div";
      }
    },
    type() {
      if (this.componentType != 'link') return this.componentType
      else  return ''
    }
  },
};
</script>
