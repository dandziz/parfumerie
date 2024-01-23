<template>
  <button
    class="btn btn-submit rounded-0 me-2 d-flex align-items-center gap-2"
    :disabled="loading"
    :type="type"
  >
    <slot></slot>
  </button>
</template>

<script>
export default defineComponent({
  props: {
    loading: {
      type: Boolean,
      default: false,
    },
    type: {
      type: String,
      default: 'button'
    }
  },
});
</script>
