<template>
  <div class="p-14">
    <div class="form-label fw-bold" v-if="!!$attrs.label">
      {{ $attrs.label }}
      <span
        class="text-danger"
        v-if="($attrs.listOfRules as string)?.includes('required')"
        >*</span
      >
    </div>
    <Field
      :name="($attrs.name as string)"
      v-slot="{ errorMessage, field }"
      :rules="($attrs.listOfRules as string)"
    >
      <v-text-field
        v-bind="{
          variant: 'outlined',
          density: 'compact',
          color: 'primary',
          ...field,
          ...$attrs,
          label: undefined,
        }"
        :error-messages="errorMessage || ($attrs.errorCustom as string | undefined)"
        @update:modelValue="onInput"
      >
        <template v-if="$attrs.icon" v-slot:prepend-inner
          ><Icon :name="($attrs.icon as string)" size="24" class="icon-color"
        /></template>
      </v-text-field>
    </Field>
  </div>
</template>

<script setup lang="ts">
defineOptions({
  name: "AppTextField",
  inheritAttrs: false,
});
</script>

<script lang="ts">
import { defineComponent } from "vue";
export default defineComponent({
  methods: {
    onInput(value: string) {
      this.$emit("update:modelValue", value);
    },
  },
});
</script>

<style lang="scss">
.icon-color {
  color: rgb(200, 200, 200);
}
.v-input--error {
  .icon-color {
    color: rgb(176, 0, 32);
  }
}
</style>
