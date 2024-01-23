<template>
  <div
    class="offcanvas offcanvas-start"
    data-bs-scroll="true"
    tabindex="-1"
    id="offcanvasWithBothOptions"
    aria-labelledby="offcanvasWithBothOptionsLabel"
  >
    <div class="offcanvas-header bg-success" style="display: flex; justify-content: end">
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
            <a href="index.php?controller=KhachHang&action=DangXuat" class="text-white"
              >ĐĂNG XUẤT</a
            >
          </button>
          <button
            type="button"
            class="btn btn-outline-light rounded-0"
            style="transform: translateX(-5px)"
          >
            <a href="index.php?controller=KhachHang&action=DangNhap" class="text-white"
              >ĐĂNG NHẬP</a
            >
          </button>
          <button
            type="button"
            class="btn btn-outline-light rounded-0"
            style="transform: translateX(5px)"
          >
            ĐĂNG KÝ
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
          <a href="index.php?controller=khachhang&action=yeuthich" style="color: white">
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
          <a class="p-14 m-0 text-black" href="index.php?controller=NuocHoa&action=Blog"
            >Blog</a
          >
        </div>
        <div style="background-color: white" class="p-2 border-bottom">
          <a class="p-14 m-0 text-black" href="index.php?controller=NuocHoa&action=LienHe"
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
</template>
