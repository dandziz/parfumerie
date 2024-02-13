<template>
  <div class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="container">
      <div class="row customer-wrapper">
        <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
          <CustomerSidebar />
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac">
          <h5 class="text-uppercase fw-normal account-info">
            Đổi mật khẩu
          </h5>
          <p>Để đảm bảo tính bảo mật vui lòng đặt mật khẩu với ít nhất 8 kí tự</p>
          <AppTextField label="Mật khẩu cũ" placeholder="Mật khẩu cũ" listOfRules="required"></AppTextField>
          <AppTextField label="Mật khẩu mới" placeholder="Mật khẩu mới" listOfRules="required"></AppTextField>
          <AppTextField label="Xác nhận lại mật khẩu" placeholder="Xác nhận lại mật khẩu" listOfRules="required"></AppTextField>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  setup() {
    return {};
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/customer", name: "Trang khách hàng", active: false },
        { to: "/customer/change-password", name: "Đổi mật khẩu", active: true },
      ],
    }
  },
};
</script>

<style lang="scss" scoped></style>
