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
            Thông tin tài khoản
          </h5>
          <p><strong>Họ tên: </strong>Đào Duy Đán</p>
          <p><strong>Email:</strong> daodan2612@gmail.com</p>
          <p><strong>Điện thoại:</strong> 0366887398</p>
          <p>
            <strong>Địa chỉ :</strong> 61 Ngõ 354 Trường Chinh, Phường Khương
            Thượng, Quận Đống Đa, Hà Nội, Vietnam
          </p>
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
        { to: "/customer", name: "Trang khách hàng", active: true },
      ],
    };
  },
};
</script>

<style lang="scss">
.customer-wrapper {
  padding: 20px 0;
}
</style>

<style lang="scss" scoped>
.account-info {
  margin-top: 10px;
  margin-bottom: 27px;
}
.col-right-ac p {
  font-size: 14px;
  margin-bottom: 15px;
}
strong,
p {
  color: #42495b;
}
</style>
