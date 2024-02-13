<script lang="ts">
//import { User } from "@/models"
import * as yup from "yup";
import type { RESPONSE_ERROR, DATA_SUCCESS, LOGIN_FIELDS } from "@types";
import { UserRole } from "~/enums";
import { useAbility } from "@casl/vue";

export default {
  setup() {
    const schema = yup.object({
      email: yup.string().required().email(),
      password: yup.string().required().min(8),
    });
    const errors = ref<LOGIN_FIELDS>({
      email: '',
      password: '',
    });
    const ability = useAbility()
    const store = useStore()

    return { schema, errors, ability, store };
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
      isSendingMail: false,
    };
  },
  methods: {
    async handleSubmit(values: LOGIN_FIELDS) {
      this.formData = values
      if (!this.loading) {
        try {
          this.loading = true;
          const response = await this.$axios.post<DATA_SUCCESS, LOGIN_FIELDS>(
            "login",
            values
          );
          const data = response.data.data
          setToken(data.token.access_token)
          setUserAbility(JSON.stringify(data.user_ability))
          setUserInformation(JSON.stringify(data.user))
          this.store.dispatch("user/setUser", data.user)
          
          if (data.user_ability[0] == UserRole.USER) {
            const permissions = data.user_ability[1] as string[]
            permissions.forEach(element => {
              this.ability.update([{ action: element, subject: UserRole.USER }])
            });
            this.$router.replace('/')
          } else if (response.data.data.user_ability[0] == UserRole.MANAGER) {

          } else {

          }
          this.$notify({
            title: this.$t("loginSuccess"),
            text: response.data?.message,
            type: "success",
          });
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
    async resendEmail() {
      try {
        this.isSendingMail = true
        if (this.formData.email) {
          const response  = await this.$axios.post('email/resend', {
            'email': this.formData.email
          })
          this.$router.replace("/resend-email");
        } else {
          this.errors.email = this.$t('validate.required', ['Email'])
        }
      } catch(e) {
        const error = e as RESPONSE_ERROR;
        this.$notify({
          title: this.$t('error'),
          text: error.message,
          type: "error",
        })
      } finally {
        this.isSendingMail = false
      }
      
    },
    updateInformation() {
      this.errors = {
        email: "",
        password: "",
      };
      if (this.isEmailNotVerified) {
        this.isEmailNotVerified = false;
      }
    },
  },
  mounted() {},
  computed: {
    breadcrumbs() {
      return [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/login", name: "Đăng nhập", active: true },
      ];
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
            class="col-md-6 col-md-offset-3 form-group shadow-lg mb-5 bg-white position-relative"
          >
            <VOverlay
              class="component-overlay"
              persistent
              contained
              :model-value="isSendingMail"
            >
              <VProgressCircular
                indeterminate
                color="primary"
                :width="2"
                :size="50"
                class="text-success"
              />
            </VOverlay>
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
                keepValues
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
                  <a
                    class="text-decoration-none"
                    @click="resendEmail"
                    >{{ $t("requestResendEmail") }}.</a
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
