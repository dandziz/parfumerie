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

      <div
        class="offcanvas offcanvas-start"
        data-bs-scroll="true"
        tabindex="-1"
        id="offcanvasWithBothOptions"
        aria-labelledby="offcanvasWithBothOptionsLabel"
      >
        <div
          class="offcanvas-header bg-success"
          style="display: flex; justify-content: end"
        >
          <button
            type="button"
            class="btn-close bg-white"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
          ></button>
        </div>
        <div class="offcanvas-body p-0">
          <div class="bg-success text-white flex-column pb-3">
            <div class="d-flex justify-content-center">
              <div
                style="
                  background-color: #05392b;
                  width: 50px;
                  height: 50px;
                  border-radius: 100%;
                "
              >
                <span
                  class="material-icons"
                  style="font-size: 40px; margin-top: 5px; margin-left: 5px"
                >
                  account_circle
                </span>
              </div>
            </div>
            <div class="d-flex justify-content-center">
              <p class="p-14">Khách</p>
            </div>
            <div class="d-flex justify-content-center">
              <button
                type="button"
                class="btn btn-outline-light rounded-0"
                style="transform: translateX(-5px)"
              >
                <a href="index.php?controller=KhachHang" class="text-white">TÀI KHOẢN</a>
              </button>
              <button
                type="button"
                class="btn btn-outline-light rounded-0"
                style="transform: translateX(5px)"
              >
                <a
                  href="index.php?controller=KhachHang&action=DangXuat"
                  class="text-white"
                  >ĐĂNG XUẤT</a
                >
              </button>
              <button
                type="button"
                class="btn btn-outline-light rounded-0"
                style="transform: translateX(-5px)"
              >
                <a
                  href="index.php?controller=KhachHang&action=DangNhap"
                  class="text-white"
                  >ĐĂNG NHẬP</a
                >
              </button>
              <button
                type="button"
                class="btn btn-outline-light rounded-0"
                style="transform: translateX(5px)"
              >
                <a href="index.php?controller=KhachHang&action=DangKy" class="text-white"
                  >ĐĂNG KÝ</a
                >
              </button>
            </div>
            <div class="d-flex justify-content-center mt-3">
              <form
                action="index.php"
                method="GET"
                class="d-flex input-group"
                role="search"
                style="max-width: 250px"
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
                  class="btn"
                  style="background-color: #ffffff"
                  name="submit"
                  type="submit"
                >
                  <span class="material-icons"> search </span>
                </button>
              </form>
            </div>
            <div class="d-flex justify-content-center mt-3">
              <a
                href="index.php?controller=khachhang&action=yeuthich"
                style="color: white"
              >
                <span class="soLuongGioHang"></span>
                <span class="material-icons me-3"> favorite </span>
              </a>
              <a
                href="index.php?controller=khachhang&action=giohang"
                style="color: white; position: relative"
              >
                <div class="soLuongGioHang" style="transform: translateY(-8px)">
                  <p class="numberOfCart">0</p>
                </div>
                <span class="material-icons"> shopping_cart </span>
              </a>
            </div>
          </div>
          <div class="left-side-ds">
            <div style="background-color: #f6f6f7" class="p-2">
              <a class="p-13 m-0 text-black">Danh mục</a>
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <a class="p-14 m-0 text-black" href="index.php">Trang chủ</a>
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <a class="p-14 m-0 text-black">Giới thiệu</a>
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <div class="d-flex justify-content-between align-items-center">
                <a class="p-14 m-0 text-black">Thương hiệu</a>
                <span class="material-icons btn-add" style="cursor: pointer">add</span>
              </div>
              <ul style="display: none">
                <li>
                  <a
                    href="index.php?controller=NuocHoa&action=SanPham&thuonghieu=<?php echo $item['id_thuonghieu'] ?>"
                  ></a>
                </li>
              </ul>
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <div class="d-flex justify-content-between align-items-center">
                <a class="p-14 m-0 text-black">Nước hoa</a>
                <span class="material-icons btn-add" style="cursor: pointer">add</span>
              </div>
              <ul style="display: none">
                <li>
                  <a href="index.php?controller=NuocHoa&action=SanPham&all="
                    >Tất cả sản phẩm.</a
                  >
                </li>
                <li>
                  <a href="index.php?controller=NuocHoa&action=SanPham&gioitinh=Nam"
                    >Nước hoa Nam.</a
                  >
                </li>
                <li>
                  <a href="index.php?controller=NuocHoa&action=SanPham&gioitinh=Nu"
                    >Nước hoa Nữ.</a
                  >
                </li>
                <li>
                  <a href="index.php?controller=NuocHoa&action=SanPham&gioitinh=Unisex"
                    >Nước hoa Unisex.</a
                  >
                </li>
              </ul>
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <a
                class="p-14 m-0 text-black"
                href="index.php?controller=NuocHoa&action=KienThuc"
                >Kiến thức</a
              >
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <a
                class="p-14 m-0 text-black"
                href="index.php?controller=NuocHoa&action=Blog"
                >Blog</a
              >
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <a
                class="p-14 m-0 text-black"
                href="index.php?controller=NuocHoa&action=LienHe"
                >Liên hệ</a
              >
            </div>
            <div style="background-color: white" class="p-2 border-bottom">
              <a
                class="p-14 m-0 text-black"
                href="index.php?controller=NuocHoa&action=TimKiemDonHang"
                >Đơn hàng</a
              >
            </div>
          </div>
        </div>
      </div>
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
            style="background-color: #ffffff; height: 37.78px"
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
