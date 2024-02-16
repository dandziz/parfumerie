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
          <p><strong>Họ tên: </strong>{{ user.name }}</p>
          <p><strong>Email: </strong>{{ user.email }}</p>
          <p><strong>Điện thoại: </strong>{{ user.phone_number }}</p>
          <p>
            <strong>Địa chỉ: </strong>{{ user.address }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
export default {
  setup() {
    useHead({
      title: "Thông tin cá nhân",
      meta: [
        {
          name: "",
          content: "",
        },
      ],
    });
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
  computed: {
    ...mapState("user", ["user"]),
  },
};
</script>

<style lang="scss">
.customer-wrapper {
  padding: 20px 0;
}
</style>

<style lang="scss">
.account-info {
  margin-top: 10px;
  margin-bottom: 27px;
}
.col-right-ac {
  p, strong {
    font-size: 14px;
    margin-bottom: 15px;
    color: #42495b;
  }
}
</style>
