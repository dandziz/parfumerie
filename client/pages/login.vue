<script lang="ts">
//import { User } from "@/models"
import * as yup from "yup";
import type { LOGIN_FIELDS } from "~/types";
import type { RESPONSE_ERROR } from "@types";

export default {
  setup() {
    const schema = yup.object({
      email: yup.string().required().email(),
      password: yup.string().required().min(8),
    });
    const errors = ref<LOGIN_FIELDS>()

    return { schema, errors };
  },
  props: {},
  data() {
    return {
      loading: false,
      formData: {
        email: "",
        password: "",
      },
      isEmailNotVerified: false,
    };
  },
  methods: {
    async handleSubmit(values: LOGIN_FIELDS) {
      if (!this.loading) {
        try {
          this.loading = true;
          const reponse = await this.$axios.post("login", JSON.stringify(values));
          console.log(reponse);
          this.$cookies.set('Dand', '22')
          console.log(this.$cookies.get('Dand'));
          this.isEmailNotVerified = false;
        } catch (e) {
          const error = e as RESPONSE_ERROR;
          this.isEmailNotVerified = error.status == 403;
          if (error.status != 403) {
            this.$notify({
              title: this.$t("loginFailed"),
              text: error.message,
              type: "error",
            });
            this.errors = error.error as LOGIN_FIELDS;
          }
        } finally {
          this.loading = false;
        }
      }
    },
    resendEmail() {
      this.$router.replace('/resend-email')
    },
    updateInformation() {
      this.errors = {
        email: '',
        password: ''
      }
      if(this.isEmailNotVerified) {
        this.isEmailNotVerified = false
      }
    },
  },
  mounted() {},
  computed: {
    breadcrumbs() {
      return [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/login", name: "Đăng nhập", active: true },
      ]
    },
  },
};
</script>

<template>
  <div>
    <Head>
      <Title>Đăng nhập</Title>
    </Head>
    <main class="bg-white">
      <Breadcrumb :breadcrumbs="breadcrumbs" />
      <div class="container pb-3 border">
        <div class="row">
          <div class="col-md-3"></div>
          <div
            class="col-md-6 col-md-offset-3 form-group shadow-lg mb-5 bg-white"
          >
            <div>
              <h5 class="text-center">{{ $t("loginTitle").toUpperCase() }}</h5>
              <p class="p-14 text-center mt-4">
                Nếu bạn đã có tài khoản, đăng nhập tại đây.
              </p>
            </div>
            <div>
              <Form
                class="row g-3"
                :initial-values="formData"
                :validation-schema="schema"
                @submit="handleSubmit"
              >
                <div class="col-md-12">
                  <VTextInput
                    name="email"
                    :label="$t('email')"
                    placeholder="Your email"
                    @onInput="updateInformation"
                    :error-message="errors?.email"
                  />
                </div>
                <div class="col-md-12">
                  <VTextInput
                    name="password"
                    :label="$t('password')"
                    placeholder="Password"
                    type="password"
                    :error-message="errors?.password"
                  />
                </div>
                <p class="p-14 mt-3 mb-0 text-red" v-show="isEmailNotVerified">
                  {{ $t("emailNotVerified") }},
                  <NuxtLink to="/register" class="text-decoration-none" @click="resendEmail"
                    >{{ $t("requestResendEmail") }}.</NuxtLink
                  >
                </p>
                <div>
                  <EffectButton type="submit">
                    {{ $t("login").toUpperCase() }}
                    <VProgressCircular
                      indeterminate
                      color="white"
                      :width="2"
                      :size="20"
                      v-if="loading"
                    />
                  </EffectButton>
                </div>
              </Form>
            </div>
            <div>
              <p class="p-14 mt-3">
                {{ $t("notHaveAccount") }},
                <NuxtLink to="/register" class="text-decoration-none"
                  >{{ $t("registerHere") }}.</NuxtLink
                >
              </p>
              <NuxtLink
                to="/forgot-password"
                class="p-14 text-decoration-none text-dark"
                >{{ $t("forgotPassword") }}</NuxtLink
              >
            </div>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </main>
  </div>
</template>

<style></style>
