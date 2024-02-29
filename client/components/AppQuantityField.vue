<template>
  <div class="d-flex quantity-wrapper">
    <div class="input-group-prepend">
      <button @click="modelValue > 1 ? $emit('update:modelValue', modelValue - 1) : ''" class="left">-</button>
    </div>
    <v-text-field
      label=""
      :model-value="modelValue"
      variant="plain"
      density="compact"
      name="count"
      class="hidden-details input-number border"
      min="1"
      type="number"
      @update:modelValue="onInput"
    ></v-text-field>
    <div class="input-group-prepend">
      <button @click="$emit('update:modelValue', modelValue + 1)" class="right">+</button>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  setup() {
    return {};
  },
  props: {
    modelValue: {
      type: Number,
      required: true,
    }
  },
  methods: {
    onInput(value: string) {
      if (value && !isNaN(Number(value))) {
        const newValue = parseInt(value)
        if (newValue > 1)
          this.$emit('update:modelValue', newValue)
      }
    }
  },
});
</script>

<style lang="scss">
.quantity-wrapper {
  margin-top: 6px;
  .input-number {
    height: 40px;
    font-size: 1em;
    margin: 0;
    max-width: 80px;
    min-width: 80px;
    padding: 0 2px;
    input {
      text-align: center;
    }
  }
  .input-group-prepend {
    font-size: 20px;
    button {
      width: 40px;
      height: 40px;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
      &:hover {
        background-color: var(--green);
        color: var(--white);
      }
      &:active {
        border-color: var(--bs-btn-active-border-color);
      }
    }
    .right {
      border-right: 1px solid var(--border-color);
      border-radius: 0 4px 4px 0;
    }
    .left {
      border-left: 1px solid var(--border-color);
      border-radius: 4px 0 0 4px;
    }
  }
}
</style>
