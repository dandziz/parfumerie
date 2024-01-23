<script lang="ts">
//import { User } from "@/models"
import AxiosRepository from "~/httpRequest/AxiosRepository";
import * as yup from "yup";
import { type LOGIN_FIELDS } from "~/types/login"
import { configure } from "vee-validate";

export default defineComponent({
  setup() {
    const schema = yup.object({
      email: yup.string().required().email(),
      password: yup.string().required().min(8),
    });
    configure({
      validateOnBlur: true,
      validateOnInput: true,
    })
    return { schema };
  },
  props: {},
  data() {
    return {
      loading: false,
      formData: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    async handleSubmit(values: LOGIN_FIELDS): Promise<void> {
      console.log(this.$t('password'));
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
});
</script>

<template>
  <Head>
    <Title>Đăng nhập</Title>
  </Head>
  <main class="bg-white">
    <div class="container-fluid" style="background-color: #f9f9f9">
      <div class="container">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <NuxtLink to="/" class="p-14 text-dark">Trang chủ</NuxtLink>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
              <span class="p-14 text-dark">Đăng nhập</span>
            </li>
          </ol>
        </nav>
      </div>
    </div>
    <div class="container pb-3 border">
      <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 login-group shadow-lg mb-5 bg-white">
          <div>
            <h5 class="text-center">ĐĂNG NHẬP TÀI KHOẢN</h5>
            <p class="p-14 text-center mt-4">
              Nếu bạn đã có tài khoản, đăng nhập tại đây.
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
                <VTextInput name="email" :label="$t('email')" placeholder="Your email" />
              </div>
              <div class="col-md-12">
                <VTextInput name="password" :label="$t('password')" placeholder="Password" />
              </div>
              <div>
                <EffectButton>
                  ĐĂNG NHẬP
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
              Bạn chưa có tài khoản,
              <a
                href="index.php?controller=khachhang&action=dangky"
                class="text-decoration-none"
                >đăng ký tại đây.</a
              >
            </p>
            <a href="" class="p-14 text-decoration-none text-dark">Quên mật khẩu?</a>
          </div>
        </div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </main>
</template>

<style scoped>
.login-group {
  margin-top: 2rem;
  margin-left: 0.5rem;
  margin-right: 0.5rem;
  padding-top: 1.5rem;
  padding-bottom: 1.5rem;
}

@media screen and (max-width: 992px) {
  .login-group {
    margin-left: 0;
    margin-right: 0;
    margin-top: 0;
  }
}

</style>
