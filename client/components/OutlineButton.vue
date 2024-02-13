<template>
  <component
    :is="renderedComponent"
    :type="type"
    class="btn app-btn-outline"
    :class="{
      bg,
      'rounded-0': !borderRadius,
      'rounded-sm': borderRadius,
      'outline-secondary': secondary,
      'outline-success': success,
      'outline-white': white,
      'border': border,
    }"
    :to="to"
  >
    <slot></slot>
  </component>
</template>

<script>
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
    to: {
      type: String,
      default: "",
    },
    type: {
      type: String,
      default: "button",
    },
    borderRadius: {
      type: Boolean,
      default: true,
    },
    secondary: {
      type: Boolean,
      default: true,
    },
    success: {
      type: Boolean,
      default: false,
    },
    white: {
      type: Boolean,
      default: false,
    },
    border: {
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
  },
};
</script>

<style lang="scss">
.app-btn-outline {
  background: unset;
  color: var(--black);
  &.outline-secondary:hover {
    background: var(--light-gray);
    color: var(--white) !important;
  }
  &.outline-success:hover {
    background: var(--green);
    color: var(--white) !important;
  }
  &.outline-white:hover {
    background: var(--white);
    color: var(--black) !important;
  }
  &.border {
    border: 1px solid var(--white) !important;
  }
}
</style>
