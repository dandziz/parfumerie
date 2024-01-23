<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="d-flex">
      <SearchInput></SearchInput>
      
      <NuxtLink to="/" class="logo_wrapper d-flex align-items-center justify-content-center">
        <div class="navbar-brand" href="index.php">
          <img src="/images/header/logo.png" class="logo" alt="" />
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
