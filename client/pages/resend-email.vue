<template>
  <div>
    <Head>
      <Title>Xác thực email</Title>
    </Head>
    <main class="bg-white">
      <Breadcrumb :breadcrumbs="breadcrumbs" />
      <div class="container pb-3 border">
        <div class="row">
          <div class="col-md-3"></div>
          <div
            class="col-md-6 col-md-offset-3 form-group shadow-lg mb-5 bg-white"
          >
            <img src="/images/email/send-mail.png" class="resend-img" alt="" />
            <h6 class="text-center">Email đã được gửi đi!</h6>
            <p class="p-14 text-gray text-center">
              Email chứa đường dẫn xác thực tài khoản của bạn đã được gửi đi.
              Vui lòng kiểm tra hộp thư của bạn!
            </p>
            <div class="d-flex justify-content-center">
              <AppButton componentType="link" to="/login">Đăng Nhập</AppButton>
            </div>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  setup() {
    return {};
  },
  computed: {
    breadcrumbs() {
      return [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/resend-email", name: "Nhận email xác thực", active: true },
      ];
    },
  },
};
</script>

<style lang="scss" scoped>
.resend-img {
  position: relative;
  width: 20%;
  height: auto;
  left: 50%;
  transform: translateX(-50%);
  margin: 20px 0;
}
</style>
