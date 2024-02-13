<template>
  <div class="p-14">
    <div class="form-label fw-bold">{{ label }}</div>
    <v-text-field
      :model-value="modelValue"
      density="compact"
      variant="outlined"
      color="primary"
      :placeholder="placeholder"
      :rules="rules as readonly ValidationRule$1[]"
      @update:modelValue="onInput"
    >
      <template v-if="icon" v-slot:prepend-inner
        ><Icon :name="icon" size="24" class="icon-color"
      /></template>
    </v-text-field>
  </div>
</template>

<script lang="ts">
type ValidationResult = string | boolean;
type ValidationRule$1 =
  | ValidationResult
  | PromiseLike<ValidationResult>
  | ((value: any) => ValidationResult)
  | ((value: any) => PromiseLike<ValidationResult>);
export default {
  setup() {
    return {};
  },
  props: {
    label: {
      type: String,
      required: true,
    },
    placeholder: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
    },
    modelValue: {
      type: String,
      required: true,
    },
    rules: {
      type: Array,
      default: [],
    },
  },
  data() {
    return {};
  },
  methods: {
    onInput(value: string) {
      this.$emit("update:modelValue", value);
    },
  },
};
</script>

<style lang="scss" scoped>
.icon-color {
  color: rgb(200, 200, 200);
}
.v-input--error {
  .icon-color {
    color: rgb(176, 0, 32);
  }
}
</style>
