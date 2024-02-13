<template>
  <div class="p-14">
    <div class="form-label fw-bold">{{ $attrs.label }}</div>
    <Field
      :name="($attrs.name as string)"
      v-slot="{ errorMessage, field }"
      :rules="($attrs.listOfRules as string)"
    >
    <v-select
      v-bind="{
        ...$attrs,
        label: undefined,
        variant: 'outlined',
        density: 'compact',
        ...field
      }"
      :error-messages="errorMessage"
      :color="$attrs.readonly ? 'dark' : 'primary'"
      @update:modelValue="onInput"
    >
      <template v-if="$attrs.icon" v-slot:prepend-inner
        ><Icon :name="($attrs.icon as string)" size="24" class="icon-color"
      /></template>
    </v-select>
  </Field>
  </div>
</template>

<script lang="ts">
import { requiredValidator } from '~/core';
export default {
  setup() {
    return {
      requiredValidator
    };
  },
  data() {
    return {};
  },
  methods: {
    onInput(value: string) {
      if (value) {
        this.$emit("update:modelValue", value);
        this.$emit("onChange", value);
      }
    },
  },
};
</script>

<style lang="scss" scoped>
.icon-color {
  color: rgb(200, 200, 200);
}
</style>
