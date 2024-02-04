<template>
  <div class="col-md-12">
    <label class="form-label"
      >{{ label }}<span style="color: red" v-if="required">*</span></label
    >
    <Field :name="name || ''" v-slot="{ field, meta }">
      <input
        v-bind="field"
        :type="type"
        class="form-control"
        :placeholder="placeholder"
        :class="{ 'is-invalid': meta.touched && !meta.valid, 'is-valid': meta.touched && meta.valid }"
        @input="$emit('onInput')"
      />
      <ErrorMessage v-if="!errorMessage" :name="name || ''" v-slot="{ message }">
        <div class="invalid-feedback text-red" v-show="errorMessage || meta.touched">{{ errorMessage || formatError(message || "") }}</div>
        {{ errorMessage }}
      </ErrorMessage>
      <div v-else class="invalid-feedback text-red">{{ errorMessage }}</div>
    </Field>
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
    errorMessage: {
      type: String,
      default: ''
    }
  },
});
</script>
