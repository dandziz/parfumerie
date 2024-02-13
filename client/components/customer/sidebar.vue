<template>
  <div class="block-account">
    <h5 class="text-uppercase fw-normal">Trang cá nhân</h5>
    <p class="p-14-bold">
      Xin chào, <span class="text-success fw-bold">Đào Duy Đán</span>
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
import type { RESPONSE_DATA_SUCCESS } from '~/types'
export default {
  setup() {
    const route = useRoute();
    const currentUrl = route.path;
    return { currentUrl };
  },
  data() {
    return {
      items: [
        { to: "/customer", text: "Thông tin tài khoản" },
        { to: "/customer/order", text: "Đơn hàng của bạn" },
        { to: "/customer/change-password", text: "Đổi mật khẩu" },
        { to: "/customer/address", text: "Sổ địa chỉ " },
      ],
    };
  },
  async mounted() {
    try {
      const response = await this.$axios.get<RESPONSE_DATA_SUCCESS<number>>('user/addresses/count');
      this.items[3].text = `Sổ địa chỉ (${response.data.data})`;
    } catch (e) {

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
