<template>
  <div class="col-md-12">
    <label class="form-label"
      >{{ label }}<span style="color: red" v-if="required">*</span></label
    >
    <Field :name="name || ''" v-slot="{ field }">
      <input
        v-bind="field"
        :type="type"
        class="form-control"
        :placeholder="placeholder"
      />
    </Field>

    <ErrorMessage :name="name || ''" v-slot="{ message }">
      <div class="invalid-feedback">{{ formatError(message || "") }}</div>
    </ErrorMessage>
  </div>
</template>

<script lang="ts">
export default defineComponent({
  props: {
    type: {
      type: String,
      default: "text",
    },
    name: {
      type: String,
      require: true,
    },
    label: {
      type: String,
      require: true,
    },
    placeholder: {
      type: String,
      default: "",
    },
    debug: {
      type: Boolean,
      default: false,
    },
    required: {
      type: Boolean,
      default: true,
    },
  },
});
</script>
