<template>
  <main class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="container pb-3 border">
      <div class="row border-bottom">
        <div class="col-md-12 mt-3">
          <h5 class="text-uppercase">Giỏ hàng <span class="p-15 slsp"></span></h5>
        </div>
      </div>
      <form class="row border-bottom row-main-giohang">
        <div class="col-md-9 gio_hang"></div>
        <div class="col-md-3">
          <div class="row border-bottom" style="padding: 15px 0px">
            <div class="col-md-12 d-flex flex-row justify-content-between">
              <span class="p_cost">Tạm tính:</span>
              <span class="p_cost tam-tinh"></span>
            </div>
          </div>
          <div class="row" style="padding: 15px 0px">
            <div class="col-md-12 d-flex flex-row justify-content-between mb-4">
              <span class="p_cost mt-2">Thành tiền:</span>
              <span
                class="p_cost thanh-tien"
                style="font-size: 21px; color: #07503d"
              ></span>
            </div>
            <div class="col-md-12">
              <a
                class="btn btn-success"
                href="index.php?controller=KhachHang&action=MuaHang"
                style="width: 100%"
                >MUA NGAY</a
              >
            </div>
            <div class="col-md-12 mt-2">
              <a
                class="btn"
                href="index.php"
                type="submit"
                style="
                  width: 100%;
                  background-color: white;
                  color: #07503d;
                  border: 1px solid #07503d;
                "
                >TIẾP TỤC MUA HÀNG</a
              >
            </div>
          </div>
        </div>
      </form>
    </div>
  </main>
</template>

<script lang="ts">
export default defineComponent({
  setup() {
    const route = useRoute();
    console.log(route);
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/customer", name: "Trang khách hàng", active: false },
        { to: "/customer/cart", name: "Giỏ hàng", active: true },
      ],
    }
  },
})
</script>

<style lang="scss" scoped></style>
