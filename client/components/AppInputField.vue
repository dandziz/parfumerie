<template>
  <div class="p-14">
    <div class="form-label fw-bold" v-if="!!$attrs.label">
      {{ $attrs.label }} <span class="text-danger" v-if="$attrs.rules">*</span>
    </div>
    <v-text-field
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
    </v-text-field>
  </div>
</template>

<script setup lang="ts">
defineOptions({
  name: "AppInputField",
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
      this.$emit("onInput", val);
    },
  },
});
</script>

<style scoped></style>
