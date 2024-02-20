<template>
  <Form
    class="col-md-4 p-3"
    :validation-schema="schema"
    :initial-values="formData"
    @submit="handleSubmit"
  >
    <VTextInput name="name" :label="$t('name')" placeholder="Your name" />
    <AppButton class="btn btn-submit mt-3" type="submit">Submit</AppButton>
  </Form>
</template>

<script lang="ts" setup>
import { object, string, ref as yupRef } from "yup";
import { configure } from "vee-validate";

const schema = object({
  name: string().required(),
});

configure({
  validateOnBlur: true,
  validateOnInput: true,
})
</script>

<script lang="ts">
import { type User } from '~/models'
export default defineComponent({
  data() {
    return {
      formData: {
        name: "",
      },
    };
  },
  methods: {
    handleSubmit(values: Pick<User, "name">) {
      console.log(values);
    },
  },
});
</script>
