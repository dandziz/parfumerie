<template>
  <v-dialog
    class="custom-modal"
    :model-value="modelValue"
    :max-width="($attrs.size as number)"
    @update:modelValue="closeModal"
  >
    <v-card>
      <v-card-title class="pt-0 d-flex justify-content-between"
        ><div>{{ $attrs.title }}</div>
        <div>
          <Icon
            name="iconamoon:close-bold"
            class="cursor-pointer"
            @click="closeModal"
          ></Icon></div
      ></v-card-title>
      <v-divider class="mb-0 mt-0"></v-divider>
      <slot name="body"></slot>
    </v-card>
  </v-dialog>
</template>

<script lang="ts">
export default {
  setup() {
    return {};
  },
  props: {
    modelValue: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {};
  },
  methods: {
    closeModal() {
      this.$emit("update:modelValue", false);
    },
  },
};
</script>

<style lang="scss" scoped></style>
