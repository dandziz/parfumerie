<template>
  <div>
    <Field :name="($attrs.name as string)">
      <v-checkbox
        v-bind="{
          ...$attrs,
          color: 'primary',
          density: 'compact',
        }"
        @update:modelValue="onChecked"
      ></v-checkbox>
    </Field>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  setup() {
    return {};
  },
  methods: {
    onChecked(value: unknown) {
      this.$emit("update:modelValue", value);
    },
  },
});
</script>

<style scoped></style>
