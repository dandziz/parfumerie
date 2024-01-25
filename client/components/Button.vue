<template>
  <component
    class="btn btn-success"
    :class="{ bg, 'rounded-0': !borderRadius, 'rounded-sm': borderRadius }"
    :to="to"
    :is="renderedComponent"
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
    borderRadius: {
      type: String,
      default: "",
    },
    to: {
      type: String,
      default: "",
    },
  },
  computed: {
    renderedComponent() {
      if (this.componentType === "button") {
        return "button";
      } else if (this.componentType === "link") {
        return "NuxtLink";
      } else {
        return "div";
      }
    },
  },
};
</script>
