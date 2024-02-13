import { defineRule } from "vee-validate";
// import { required, email, min } from '@vee-validate/rules';
import * as rules from "@vee-validate/rules";
import { localize } from '@vee-validate/i18n';
import type { string } from "yup";

configure({
  // Generates an English message locale generator
  generateMessage: localize('vn', {
    messages: {
      required: 'Trường này là bắt buộc',
      email: 'Email không đúng định dạng'
    },
  }),
});

export default defineNuxtPlugin((nuxtApp) => {
  Object.keys(rules)
    .filter((k) => k !== "default")
    .forEach((rule) => {
      defineRule(rule, rules[rule]);
    });
});

defineRule('phoneNumber', (value: string) => {
  const regex = /^(0|\+84|84)[1-9][0-9]{8}$/
  if (!regex.test(value)) {
    return 'Số điện thoại không hợp lệ!';
  }
  return true;
});
