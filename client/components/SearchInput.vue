<template>
  <div class="d-flex flex-row align-items-center search-input">
    <input
      type="text"
      :placeholder="placeholder"
      :value="modelValue"
      @input="$emit('update:modelValue', $event.target.value)"
      class="form-control"
    />
    <Icon size="36px" name="majesticons:search-line" />
  </div>
</template>

<script>
export default {
  setup() {},
  props: {
    placeholder: {
      type: String,
      default: "",
    },
    modelValue: {
      type: String,
      default: "",
    },
  },
};
</script>
