<template>
  <div class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="container">
      <div class="row customer-wrapper">
        <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
          <CustomerSidebar />
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac">
          <h5 class="text-uppercase fw-normal account-info">Đổi mật khẩu</h5>
          <p>
            Để đảm bảo tính bảo mật vui lòng đặt mật khẩu với ít nhất 8 kí tự
          </p>
          <v-form v-model="formValidation" @submit.prevent="onSubmit">
            <app-password-field
              label="Mật khẩu cũ"
              v-model="forms.oldPassword"
              :rules="[requiredValidator, minValidator(forms.oldPassword, 8)]"
              v-model:errorCustom="errors.oldPassword"
            ></app-password-field>
            <app-password-field
              label="Mật khẩu mới"
              v-model="forms.password"
              :rules="[requiredValidator, minValidator(forms.password, 8)]"
              v-model:errorCustom="errors.password"
            ></app-password-field>
            <app-password-field
              label="Xác nhận lại mật khẩu"
              v-model="forms.passwordConfirmation"
              :rules="[
                requiredValidator,
                confirmedValidator(forms.password, forms.passwordConfirmation),
              ]"
              v-model:errorCustom="errors.passwordConfirmation"
            ></app-password-field>
            <AppButton type="submit" class="text-white text-uppercase" :loading="submitLoading"
              >Đặt lại mật khẩu
            </AppButton>
          </v-form>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { confirmedValidator, requiredValidator, minValidator } from "@validator";
import type { CHANGE_PASSWORD, RESPONSE_ERROR } from "~/types";

export default {
  setup() {
    useHead({
      title: "Đổi mật khẩu",
      meta: [
        {
          name: "",
          content: "",
        },
      ],
    });
    return {
      confirmedValidator,
      requiredValidator,
      minValidator
    };
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/customer", name: "Trang khách hàng", active: false },
        { to: "/customer/change-password", name: "Đổi mật khẩu", active: true },
      ],
      forms: {
        oldPassword: "",
        password: "",
        passwordConfirmation: "",
      },
      formValidation: false,
      errors: {
        oldPassword: "",
        password: "",
        passwordConfirmation: "",
      },
      submitLoading: false,
    };
  },
  mounted() {},
  methods: {
    async onSubmit() {
      if (this.formValidation) {
        try {
          this.submitLoading = true;
          const response = await this.$axios.post<unknown, CHANGE_PASSWORD>(
            "user/change-password",
            this.forms
          );
          successfulNotification(
            convertStringToTitle(this.$t("success")),
            response.data.message
          );
          this.$router.replace("/customer");
        } catch (e) {
          const error = e as RESPONSE_ERROR;
          this.errors = { ...(error.error as CHANGE_PASSWORD) };
          if (error.message) {
            failureNotification(
              convertStringToTitle(this.$t("failed")),
              error.message
            );
          }
        } finally {
          this.submitLoading = false;
        }
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
