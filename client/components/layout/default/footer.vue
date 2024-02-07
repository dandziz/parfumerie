<template>
  <footer class="container-fluid bg-success text-white">
    <div class="container mb-5 pt-4">
      <div class="row">
        <div
          class="footer-xs-12 footer-sm-6 footer-md-3 mb-4 collapse-footer"
          v-for="(value, key) in items"
          :key="key"
        >
          <div
            class="d-flex justify-content-between"
            @click="handleCollapse(value.id)"
          >
            <p class="p-14-bold text-uppercase">{{ key }}</p>
            <Icon :name="`icon-park-outline:${currentCollapse == value.id ? 'up' : 'down'}`" v-if="mobiles" />
          </div>
          <collapse-transition>
            <div v-show="!mobiles || currentCollapse == value.id">
              <template v-for="(item, index) in value.value" :key="index">
                <NuxtLink :to="item.to" class="text-white link-footer"
                  ><span class="p-14">{{ item.title }}</span></NuxtLink
                >
                <br />
              </template>
            </div>
          </collapse-transition>
        </div>
      </div>
      <div class="row">
        <div class="footer-xs-12 footer-sm-6 footer-md-3 mb-4">
          <p class="p-14-bold">PHƯƠNG THỨC THANH TOÁN</p>
          <div class="d-flex flex-row">
            <div style="align-items: center" class="me-3">
              <Icon name="ic:baseline-account-balance" size="24px" />
              <p class="p-13 m-0">Internet Banking</p>
            </div>
            <div style="align-items: center">
              <Icon name="material-symbols-light:payments-sharp" size="24px" />
              <p class="p-13 m-0">Tiền Mặt</p>
            </div>
          </div>
        </div>
        <div class="footer-xs-12 footer-sm-6 footer-md-3 mb-4 mb-3">
          <p class="p-14-bold">KẾT NỐI VỚI CHÚNG TÔI</p>
          <div class="d-flex align-items-center gap-3">
            <a href="" style="color: #3b5998"
              ><Icon name="mdi:facebook" size="30"
            /></a>
            <a href="" style="color: #1e88e5"
              ><Icon name="mdi:instagram" size="30"
            /></a>
            <a href="" style="color: #ff0000"
              ><Icon name="mdi:youtube" size="30"
            /></a>
            <a href="" style="color: #ff0000" class="footer-connect"
              ><img src="/images/footer/map.png" alt=""
            /></a>
          </div>
        </div>
        <div class="footer-xs-12 footer-sm-12 footer-md-6 mb-4">
          <p class="p-14-bold">ĐĂNG KÝ NHẬN TIN</p>
          <p class="p-13 register-info">
            Nhận thông tin sản phẩm mới nhất, tin khuyến mãi và nhiều hơn nữa.
          </p>
          <form class="row register-form g-3" id="formNhanTin" method="POST">
            <div class="col-md-5">
              <input
                type="text"
                name="hoten"
                class="form-control rounded-sm"
                id="hoten"
                placeholder="Họ và tên"
                required
              />
            </div>
            <div class="col-md-5">
              <input
                type="text"
                name="email"
                class="form-control"
                id="guest_email"
                placeholder="Email của bạn"
                required
              />
              <span class="helpEmail p-12-bold"></span>
            </div>
            <div class="col-md-2">
              <button
                class="btn btn-submit btn-user-submit p-14 nowrap-button"
                name="submit-btn"
                type="submit"
              >
                Đăng ký
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row text-center" style="background-color: #032119">
      <p class="p-12 mt-2">
        Parfumerie.vn | Cung cấp bởi
        <a class="p-12 span-footer" href="">Sapo</a>
      </p>
    </div>
  </footer>
</template>

<style lang="scss" scoped>
@media screen and (max-width: 992px) {
  .btn-user-submit {
    font-size: 14px;
  }
}
@media screen and (max-width: 768px) {
  .content-footer {
    overflow: hidden;
  }
  .about-footer,
  .guide-footer,
  .policy-footer,
  .support-footer {
    .content-footer {
      transform: scaleY(0);
      visibility: hidden;
    }
  }
  .about-footer.active,
  .guide-footer.active,
  .policy-footer.active,
  .support-footer.active {
    .content-footer {
      transform: scaleY(1);
      visibility: visible;
    }
  }
}
</style>

<script lang="ts">
export default {
  setup() {},
  data() {
    return {
      windowWidth: window.innerWidth,
      currentCollapse: '',
      items: {
        "Về parfumerie": {
          id: "about-footer",
          value: [
            { title: "Trang chủ", to: "/" },
            { title: "Giới thiệu", to: "/" },
            { title: "Sản phẩm", to: "/" },
            { title: "Liên hệ", to: "/" },
          ],
        },
        "Hướng dẫn": {
          id: "guide-footer",
          value: [
            { title: "Hướng dẫn mua hàng", to: "/" },
            { title: "Hướng dẫn thanh toán", to: "/" },
            { title: "Hướng dẫn giao nhận", to: "/" },
            { title: "Điều khoản sử dụng", to: "/" },
          ],
        },
        "Chính sách": {
          id: "policy-footer",
          value: [
            { title: "Chính sách mua hàng", to: "/" },
            { title: "Chính sách bảo mật thông tin", to: "/" },
            { title: "Chính sách giao hàng", to: "/" },
            { title: "Chính sách đổi trả - bảo hành", to: "/" },
          ],
        },
        "Hỗ trợ": {
          id: "support-footer",
          value: [
            { title: "Tìm kiếm", to: "/" },
            { title: "Đăng nhập", to: "/" },
            { title: "Đăng ký", to: "/" },
          ],
        },
      },
    };
  },
  computed: {
    mobiles() {
      return this.$vuetify.display.width <= 768;
    },
  },
  methods: {
    handleCollapse(id: string): void {
      this.currentCollapse == id ? this.currentCollapse = '' : this.currentCollapse = id
    },
  },
};
</script>
