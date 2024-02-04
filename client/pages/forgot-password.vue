<template>
  <div>
    <Head>
      <Title>Quên mật khẩu</Title>
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
              <h5 class="text-center">
                {{ $t("resetPassword").toUpperCase() }}
              </h5>
              <p class="p-14 mt-4">
                Bạn quên mật khẩu? Nhập địa chỉ email để lấy lại mật khẩu qua
                email.
              </p>
            </div>
            <div>
              <Form
                class="row g-3"
                :validation-schema="schema"
                :initial-values="formData"
                @submit="handleSubmit"
              >
                <div class="col-md-12">
                  <VTextInput
                    name="email"
                    :label="$t('email')"
                    placeholder="Your email"
                  />
                </div>
                <div>
                  <EffectButton type="submit">
                    {{ $t("passwordRetrieval").toUpperCase() }}
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
            <div class="mt-4">
              <NuxtLink
                to="/login"
                class="p-14 text-decoration-none text-dark"
                >{{ $t("comeBackHere") }}</NuxtLink
              >
            </div>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </main>
  </div>
</template>

<script lang="ts">
//import { User } from "@/models"
import * as yup from "yup";
import type { LOGIN_FIELDS } from "~/types";

export default {
  setup() {
    const schema = yup.object({
      email: yup.string().required().email(),
    });
    return { schema };
  },
  props: {},
  data() {
    return {
      loading: false,
      formData: {
        email: "",
      },
    };
  },
  methods: {
    async handleSubmit(values: LOGIN_FIELDS) {
      console.log(values);
      const axios = new AxiosRepository();
      try {
        this.loading = true;
        const reponse = await axios.post("login", JSON.stringify(values));
        console.log(reponse);
      } catch (e) {
        console.log(e);
      } finally {
        this.loading = false;
      }
    },
  },
  computed: {
    breadcrumbs() { 
      return [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/forgot-password", name: "Đặt lại mật khẩu", active: true },
      ]
    },
  },
};
</script>

<style lang="scss" scoped></style>
