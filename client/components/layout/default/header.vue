<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <NuxtLink to="/" class="logo_wrapper d-flex align-items-center justify-content-center">
        <div class="navbar-brand" href="index.php">
          <img src="~/assets/images/header/logo.png" class="logo" alt="" />
        </div>
      </NuxtLink>
      <button
        class="btn btn-sidebar"
        type="button"
        data-bs-toggle="offcanvas"
        data-bs-target="#offcanvasWithBothOptions"
        aria-controls="offcanvasWithBothOptions"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Sidebar -->
      <LayoutDefaultSidebar />

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form
          action="index.php"
          method="GET"
          class="d-flex d-flex align-items-center input-group mb-0"
          role="search"
          style="max-width: 30%"
        >
          <input type="text" name="controller" value="NuocHoa" hidden />
          <input type="text" name="action" value="SanPham" hidden />
          <input
            class="form-control"
            type="search"
            name="query"
            placeholder="Tìm kiếm sản phẩm"
            aria-label="Search"
          />
          <button
            class="btn rounded-0"
            style="background-color: #ffffff; height: 37.6px; border-color: #dee2e6"
            name="submit"
            type="submit"
          >
            <Icon name="ic:baseline-search" color="black" size="24" />
          </button>
        </form>
        <div class="navbar-nav ms-auto mb-2 mb-lg-0 text-white">
          <div class="header-myAccount" style="border-right-style: solid">
            <p class="p-14-bold mt-3">Xin chào, Khách</p>
            <p class="p-12-bold mt-3">
              <NuxtLink to="/login">Đăng nhập</NuxtLink>
              <span class="p-12"> hoặc </span>
              <NuxtLink to="/register">Đăng ký</NuxtLink>
            </p>
          </div>
          <div class="ms-3 me-5 header-myFavorites">
            <a href="index.php?controller=khachhang&action=yeuthich" class="me-4" style="color: white">
              <Icon name="material-symbols:favorite" size="24" />
            </a>
            <a
              href="index.php?controller=khachhang&action=giohang"
              style="color: white; position: relative"
            >
              <div class="soLuongGioHang"><p class="numberOfCart p-13">0</p></div>
              <Icon name="material-symbols:shopping-cart-rounded" size="24" />
            </a>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <ul
    class="nav justify-content-center p-15-bold"
    style="background-color: #ffffff; position: relative"
  >
    <li class="nav-item">
      <a class="nav-link active text-dark" href="index.php">TRANG CHỦ</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="index.php?controller=nuochoa&action=gioithieu"
        >GIỚI THIỆU</a
      >
    </li>
    <li class="nav-item thuonghieu">
      <a class="nav-link text-dark" href="#">THƯƠNG HIỆU ></a>
      <div class="content-th shadow">
        <div class="container-fluid" style="background-color: #f9f9f9">
          <ul class="row p-3">
            <li class="col-md-15">
              <a
                href="index.php?controller=NuocHoa&action=SanPham&thuonghieu=<?php echo $item['id_thuonghieu'] ?>"
                ></a
              >
            </li>
          </ul>
        </div>
      </div>
    </li>
    <li class="nav-item nuochoa" style="position: relative">
      <a class="nav-link text-dark" href="#">NƯỚC HOA ></a>
      <div class="content-gt shadow" style="background-color: #ffffff">
        <ul>
          <li>
            <a href="index.php?controller=NuocHoa&action=SanPham&all=">Tất cả sản phẩm</a>
          </li>
          <hr style="margin: 0" />
          <li>
            <a href="index.php?controller=NuocHoa&action=SanPham&gioitinh=Nam"
              >Nước hoa Nam</a
            >
          </li>
          <hr style="margin: 0" />
          <li>
            <a href="index.php?controller=NuocHoa&action=SanPham&gioitinh=Nu"
              >Nước hoa Nữ</a
            >
          </li>
          <hr style="margin: 0" />
          <li>
            <a href="index.php?controller=NuocHoa&action=SanPham&gioitinh=Unisex"
              >Nước hoa Unisex</a
            >
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="index.php?controller=NuocHoa&action=KienThuc"
        >KIẾN THỨC</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="index.php?controller=NuocHoa&action=Blog"
        >BLOG</a
      >
    </li>
    <li class="nav-item">
      <a class="nav-link text-dark" href="index.php?controller=KhachHang&action=LienHe"
        >LIÊN HỆ</a
      >
    </li>
    <li class="nav-item">
      <a
        class="nav-link text-dark"
        href="index.php?controller=KhachHang&action=TimKiemDonHang"
        >ĐƠN HÀNG</a
      >
    </li>
  </ul>
</template>
