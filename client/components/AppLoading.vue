<template>
  <VOverlay
    class="component-overlay"
    persistent
    contained
    :model-value="modelValue"
  >
  </VOverlay>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  setup() {
    return {};
  },
  props: {
    modelValue: {
      type: Boolean,
      required: true
    }
  }
});
</script>

<style scoped></style>
