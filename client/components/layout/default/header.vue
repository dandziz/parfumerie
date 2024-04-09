<template>
  <div>
    <LayoutDefaultSidebar
      :activeSidebar="activeSidebar"
      @unactiveSidebar="unactiveSidebar"
      @logout="handleLogout"
    />
    <nav class="navbar navbar-expand-lg navbar-dark bg-success flex-column">
      <div class="w-100 container-info">
        <div class="container-fluid d-flex justify-content-between">
          <Icon
            name="ic:round-menu"
            size="24px"
            class="cursor-pointer sidebar-menu"
            @click="activeSidebar = true"
          />

          <NuxtLink
            to="/"
            class="logo_wrapper d-flex align-items-center justify-content-center"
          >
            <div class="navbar-brand" href="index.php">
              <img src="/images/header/logo.png" class="logo" alt="" />
            </div>
          </NuxtLink>

          <SearchInput class="first-search" placeholder="Tìm kiếm sản phẩm" />

          <div class="navbar-nav ms-auto mb-2 mb-lg-0 text-white">
            <div class="header-myAccount border-end position-relative">
              <p class="p-14-bold mt-3">Xin chào, {{ user.name ? user.name : 'Khách' }}</p>
              <p v-if="!$ability.can('auth', 'user')" class="p-12-bold mt-3">
                <NuxtLink to="/login">Đăng nhập</NuxtLink>
                <span class="p-12"> hoặc </span>
                <NuxtLink to="/register">Đăng ký</NuxtLink>
              </p>
              <p v-else="$ability.can('auth', 'user')" class="p-12-bold mt-3">
                <NuxtLink to="/customer">Tài khoản</NuxtLink>
                <span class="p-12"> hoặc </span>
                <span class="cursor-pointer" @click="handleLogout">Đăng xuất</span>
              </p>
              <div class="header-myAccount__info position-absolute bg-white">
                <nuxt-link to="/customer" class="text-black ">Tài khoản</nuxt-link>
                <nuxt-link to="/customer/order" class="text-black">Sổ địa chỉ</nuxt-link>
              </div>
            </div>
            <div class="ms-3 me-5 header-myFavorites d-inline-flex">
              <a class="me-4 text-white">
                <Icon name="material-symbols:favorite" size="24" />
              </a>
              <div class="position-relative my-cart">
                <NuxtLink to="/customer/cart" class="text-white my-cart-icon position-relative">
                  <Icon name="material-symbols:shopping-cart-rounded" size="24" />
                  <span class="numberOfCart p-13">{{ $store.getters['cart/getNumberOfPerfume'] }}</span>
                </NuxtLink>
                <LayoutDefaultCart></LayoutDefaultCart>
              </div>
            </div>
          </div>

          <div class="mobile-cart">
            <NuxtLink to="/customer/cart" class="text-white position-relative">
              <Icon name="material-symbols:shopping-cart-rounded" size="24" />
              <span class="numberOfCart p-13">{{ $store.getters['cart/getNumberOfPerfume'] }}</span>
            </NuxtLink>
          </div>

          <!-- Sidebar -->
        </div>
      </div>
      <div class="w-100 container-search ps-3 pr-3">
        <SearchInput placeholder="Tìm kiếm sản phẩm" />
      </div>
    </nav>
    <ul class="nav justify-content-center p-15-bold bg-white position-relative">
      <li class="nav-item">
        <a class="nav-link active text-dark">TRANG CHỦ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark">GIỚI THIỆU</a>
      </li>
      <li class="nav-item thuonghieu">
        <a class="nav-link text-dark" href="#">THƯƠNG HIỆU ></a>
        <div class="content-th shadow">
          <div class="container-fluid bg-cream">
            <ul class="row p-3">
              <li
                class="col-md-15"
                v-for="(item, index) in brands"
                :key="index"
              >
                <a>{{ item.name }}</a>
              </li>
            </ul>
          </div>
        </div>
      </li>
      <li class="nav-item nuochoa position-relative">
        <a class="nav-link text-dark" href="#">NƯỚC HOA ></a>
        <div class="content-gt shadow bg-white">
          <ul>
            <li>
              <a>Tất cả sản phẩm</a>
            </li>
            <hr class="m-0" />
            <li>
              <a>Nước hoa Nam</a>
            </li>
            <hr class="m-0" />
            <li>
              <a>Nước hoa Nữ</a>
            </li>
            <hr class="m-0" />
            <li>
              <a>Nước hoa Unisex</a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark">KIẾN THỨC</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark">BLOG</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark">LIÊN HỆ</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-dark">ĐƠN HÀNG</a>
      </li>
    </ul>
  </div>
</template>

<script lang="ts">
import { mapState } from "vuex";
import type { RESPONSE_ERROR, RESPONSE_NOT_DATA } from '@types'
export default {
  setup() {
    const store = useStore()
    return { store }
  },
  data() {
    return {
      activeSidebar: false,
    };
  },
  computed: {
    ...mapState("brand", ["brands"]),
    ...mapState("user", ["user"]),
  },
  component: {
  },
  methods: {
    unactiveSidebar() {
      this.activeSidebar = false;
    },
    async handleLogout() {
      try {
        const response = await this.$axios.post<undefined, RESPONSE_NOT_DATA>('logout')
        const data = response.data as RESPONSE_NOT_DATA
        this.$notify({ title: this.$t('success', [this.$t('logout')]), text: data.message, type: 'success' })
      } catch(e) {
        const error = e as RESPONSE_ERROR
        this.$notify({ title: this.$t('failed', [this.$t('logout')]), text: error.message, type: 'error' })
      } finally {
        logout()
        this.store.dispatch('user/logout')
        this.store.dispatch('cart/setCarts', [])
        this.$ability.update([{action: 'read', subject: 'guest'}])
        if (this.$route.path != '/')
          this.$router.replace('/')
      }
    }
  },
  watch: {
    activeSidebar() {
      document.documentElement.classList.toggle("frozen");
    },
  },
  mounted () {
    console.log(this.$ability.can('auth', 'user'));
  },
};
</script>

<style lang="scss">
.my-cart {
  width: 54px;
  display: flex;
  justify-content: center;
  align-items: center;
  .my-cart-icon {
    line-height: 24px;
  }
  &:hover {
    box-shadow: rgba(0,0,0,0.15) 0px 1px 8px;
    border-right-width: 0 !important;
  }
  &:hover .my-cart-body {
    display: block;
  }
}
</style>
