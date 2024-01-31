<template>
  <div>
    <LayoutDefaultSidebar :activeSidebar="activeSidebar" @unactiveSidebar="activeSidebar=false" />
    <nav class="navbar navbar-expand-lg navbar-dark bg-success flex-column">
      <div class="w-100 container-info">
        <div class="container-fluid d-flex justify-content-between">
          <Icon name="ic:round-menu" size="24px" class="cursor-pointer sidebar-menu" @click="activeSidebar = true" />

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
            <div class="header-myAccount border-end">
              <p class="p-14-bold mt-3">Xin chào, Khách</p>
              <p class="p-12-bold mt-3">
                <NuxtLink to="/customer">Đăng nhập</NuxtLink>
                <span class="p-12"> hoặc </span>
                <NuxtLink to="/register">Đăng ký</NuxtLink>
              </p>
            </div>
            <div class="ms-3 me-5 header-myFavorites">
              <a
                class="me-4 text-white"
              >
                <Icon name="material-symbols:favorite" size="24" />
              </a>
              <a
                class="text-white position-relative"
              >
                <div class="soLuongGioHang">
                  <p class="numberOfCart p-13">0</p>
                </div>
                <Icon name="material-symbols:shopping-cart-rounded" size="24" />
              </a>
            </div>
          </div>

          <div class="mobile-cart">
            <a
              class="text-white position-relative"
            >
              <div class="soLuongGioHang">
                <p class="numberOfCart p-13">0</p>
              </div>
              <Icon name="material-symbols:shopping-cart-rounded" size="24" />
            </a>
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
              <li class="col-md-15" v-for="(item, index) in brands" :key="index">
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

<script>
import { mapState } from 'vuex'
export default {
  data() {
    return {
      activeSidebar: false,
    }
  },
  computed: {
    ...mapState("brand", ["brands"]),
  },
}
</script>
