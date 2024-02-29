<template>
  <div class="block-account">
    <h5 class="text-uppercase fw-normal">Trang cá nhân</h5>
    <p class="p-14-bold">
      Xin chào, <span class="text-success fw-bold">{{ user.name }}</span>
    </p>
    <ul>
      <li v-for="(item, index) in items" :key="index">
        <NuxtLink
          :to="item.to"
          class="p-14 text-dark"
          :class="{ 'text-decoration-underline': currentUrl == item.to }"
          >{{ item.text }}</NuxtLink
        >
      </li>
    </ul>
  </div>
</template>

<script lang="ts">
import { mapState } from "vuex";
export default {
  setup() {
    const route = useRoute();
    const currentUrl = route.path;
    return { currentUrl };
  },
  data() {
    return {
      
    };
  },
  async mounted() {
    
  },
  computed: {
    ...mapState("user", ["numberOfAddresses"]),
    ...mapState("user", ["user"]),
    items() {
      return [
        { to: "/customer", text: "Thông tin tài khoản" },
        { to: "/customer/order", text: "Đơn hàng của bạn" },
        { to: "/customer/change-password", text: "Đổi mật khẩu" },
        { to: "/customer/address", text: `Sổ địa chỉ (${this.numberOfAddresses})` },
      ];
    }
  }
};
</script>

<style lang="scss" scoped>
.block-account {
  ul {
    list-style-type: none;
    padding-left: 0;
    margin-top: 28px;
    li {
      margin-bottom: 10px;
    }
  }
}
</style>
