<template>
  <div class="p-14">
    <div class="form-label fw-bold">
      {{ $attrs.label }} <span class="text-danger" v-if="$attrs.rules">*</span>
    </div>
    <v-combobox
      v-bind="{
        ...$attrs,
        label: undefined,
        variant: 'outlined',
        density: 'compact',
        color: 'primary',
      }"
      :error-messages="($attrs.errorCustom as string | undefined)"
      @update:modelValue="onInput"
    >
      <template v-if="$attrs.icon" v-slot:prepend-inner
        ><Icon :name="($attrs.icon as string)" size="24" class="icon-color"
      /></template>
    </v-combobox>
  </div>
</template>

<script setup lang="ts">
defineOptions({
  name: "AppAutocompleteField",
  inheritAttrs: false,
});
</script>

<script lang="ts">
import { defineComponent } from "vue";
export default defineComponent({
  methods: {
    onInput(value: string) {
      let val = value
      if (this.$attrs?.transfer && value && this.$attrs?.transfer == 'uppercase')  val = value.toUpperCase()
      this.$emit("update:modelValue", val);
      this.$emit("update:errorCustom", "");
      this.$emit("onChange");
    },
  },
});
</script>

<style scoped></style>
