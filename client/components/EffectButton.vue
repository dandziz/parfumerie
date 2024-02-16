<template>
  <button
    class="btn btn-effect btn-submit rounded-0 me-2 d-flex align-items-center gap-2"
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
  </button>
</template>

<script lang="ts">
export default {
  props: {
    loading: {
      type: Boolean,
      default: false,
    },
    type: {
      type: String,
      default: "button",
    },
  },
};
</script>

<style lang="scss" scoped>
.btn-effect {
  transition: 0.8s;
}
</style>
