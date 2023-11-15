<script lang="ts">
//import { User } from "@/models"
import AxiosRepository from '~/httpRequest/AxiosRepository'
import * as yup from 'yup'

export default defineComponent({
  setup() {
    const schema = yup.object({
      email: yup.string().required().email(),
      password: yup.string().required().min(8),
    });
    return { schema }
  },
  props: {

  },
  data() {
    return {
      loading: false,
      formData: {
        email: '',
        password: '',
      }
    }
  },
  methods: {
    async onSubmit(): Promise<void> {
      console.log(yup);
      const axios = new AxiosRepository()
      try {
        this.loading = true;
        const reponse = await axios.post('login', JSON.stringify({...this.formData}))
        console.log(reponse);
      } catch (e) {
        console.log(e);
      } finally {
        this.loading = false;
      }
    }
  }
})
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
        <div class="col-md-4"></div>
        <div class="col-md-4 ms-2 me-2 mt-5 shadow-lg mb-5 bg-white pt-3 pb-3">
          <div>
            <h5 class="text-center">ĐĂNG NHẬP TÀI KHOẢN</h5>
            <p class="p-14 text-center mt-4">
              Nếu bạn đã có tài khoản, đăng nhập tại đây.
            </p>
          </div>
          <div>
            <Form class="row g-3 needs-validation" :validation-schema="schema">
              <div class="col-md-12">
                <label for="validationCustom01 p-14-bold" class="form-label"
                  >Email hoặc Số điện thoại<span style="color: red">*</span></label
                >
                <input v-model="formData.email" type="text" class="form-control" placeholder="Email" required />
                <div class="invalid-feedback" id="oldPassword-feedback">
                  Vui lòng nhập tài khoản của bạn!
                </div>
              </div>
              <div class="col-md-12">
                <label for="validationCustom02 p-14-bold" class="form-label"
                  >Mật khẩu<span style="color: red">*</span></label
                >
                <input
                  v-model="formData.password"
                  type="password"
                  class="form-control"
                  name="matkhau"
                  placeholder="Mật khẩu"
                  required
                />
                <div class="invalid-feedback">Vui lòng nhập mật khẩu của bạn!</div>
              </div>
              <div>
                <button class="btn btn-submit rounded-0 me-2 d-flex align-items-center gap-2" name="submit" :disabled="loading" type="button" @click="onSubmit">
                  ĐĂNG NHẬP
                  <VProgressCircular
                    indeterminate
                    color="white"
                    :width="2"
                    :size="20"
                    v-if="loading"
                  />
                </button>
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
