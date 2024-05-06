<template>
  <main class="bg-white position-relative">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <app-loading v-model="loading"></app-loading>
    <div class="container pb-3 border">
      <div class="row border-bottom">
        <div class="col-md-12 mt-3">
          <h5 class="text-uppercase d-inline-flex me-2">
            Giỏ hàng <span class="p-15 slsp"></span>
          </h5>
          <span class="p-14"
            >({{ $store.getters["cart/getNumberOfPerfume"] }}) sản phẩm</span
          >
        </div>
      </div>
      <div v-if="carts.length > 0" class="row border-bottom row-main-giohang">
        <div class="col-md-9 gio_hang">
          <div class="row row-sp" v-for="cart in carts" :key="cart?.id">
            <div class="col-md-3 card_gio_hang">
              <img :src="cart.img_link" alt="" />
            </div>
            <div class="col-md-9">
              <div class="row">
                <div class="col-lg-9 col-md-8">
                  <div class="row">
                    <div class="col-lg-8 col-md-12">
                      <NuxtLink
                        :to="{ name: 'slug', params: { slug: cart.slug } }"
                        class="p-14-bold text-black text-decoration-none"
                        >{{ cart.name }}</NuxtLink
                      >
                    </div>
                    <div class="col-lg-4 col-md-12">
                      <p class="p-15-bold text-gray">
                        {{ formatMoney(cart.unit_price) }}
                      </p>
                    </div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-4">
                  <div class="swatch">
                    <app-quantity-field
                      v-model="cart.quantity"
                      @onChange="(value: number) => handleChange(cart.id, value)"
                      @onIncrease="handleIncrease(cart.id, cart.quantity + 1)"
                      @onReduce="handleReduce(cart.id, cart.quantity - 1)"
                      config
                    ></app-quantity-field>
                  </div>
                </div>
                <div class="col-md-12">
                  <button
                    type="button"
                    @click="handleDeletePerfume(cart.id)"
                    class="p-14 text-primary xoaSanPham"
                  >
                    Xóa
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="row row-sp border-bottom">
            <div class="col-md-12 d-flex flex-row justify-content-between">
              <span class="p_cost">Tạm tính:</span>
              <span class="p_cost tam-tinh">{{
                formatMoney($store.getters["cart/getTotalMoney"])
              }}</span>
            </div>
          </div>
          <div class="row row-sp">
            <div class="col-md-12 d-flex flex-row justify-content-between mb-4">
              <span class="p_cost mt-2">Thành tiền:</span>
              <span
                class="p_cost thanh-tien text-success"
                style="font-size: 21px"
                >{{ formatMoney($store.getters["cart/getTotalMoney"]) }}</span
              >
            </div>
            <div class="col-md-12">
              <NuxtLink class="btn btn-success w-100" to="/checkout">MUA NGAY</NuxtLink>
            </div>
            <div class="col-md-12 mt-2">
              <NuxtLink class="btn btn-continue-shopping" to="/">
                TIẾP TỤC MUA HÀNG
              </NuxtLink>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="row border-bottom row-main-giohang">
        <img class="cart-empty" src="/images/ticket/empty-bags.jpg" alt="" />
        <div class="d-flex justify-content-center pt-5 pb-5">
          <app-button componentType="link" to="/">TIẾP TỤC MUA SẮM</app-button>
        </div>
      </div>
    </div>
  </main>
</template>

<script lang="ts">
import { type Cart } from "~/models";
import { type TIMEOUT_ID } from "@types";
import { mapState } from "vuex";

export default defineComponent({
  setup() {
    const route = useRoute();
    const { $store } = useNuxtApp();
    const timeoutId = ref<TIMEOUT_ID>({});
    useHead({
      title: "Giỏ hàng",
    });
    definePageMeta({
      middleware: ["customer"],
    });
    return {
      timeoutId,
    };
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/customer", name: "Trang khách hàng", active: false },
        { to: "/customer/cart", name: "Giỏ hàng", active: true },
      ],
      quantity: 0,
      loading: false,
    };
  },
  mounted() {},
  computed: {
    ...mapState("cart", ["carts"]),
  },
  methods: {
    async handleIncrease(id: number, value: number) {
      clearTimeout(this.timeoutId[id]);
      const payload = {
        id,
        action: "increase",
      };
      this.$store.dispatch("cart/handleChanges", payload);
      this.timeoutId[id] = setTimeout(() => {
        this.handleUpdate(id, value);
      }, 1500);
    },
    async handleReduce(id: number, value: number) {
      clearTimeout(this.timeoutId[id]);
      const payload = {
        id,
        action: "reduce",
      };
      this.$store.dispatch("cart/handleChanges", payload);
      this.timeoutId[id] = setTimeout(() => {
        this.handleUpdate(id, value);
      }, 1500);
    },
    async handleChange(id: number, newValue: number) {
      clearTimeout(this.timeoutId[id]);
      const payload = {
        id,
        action: "change",
        quantity: newValue,
      };
      this.$store.dispatch("cart/handleChanges", payload);
      this.timeoutId[id] = setTimeout(() => {
        this.handleUpdate(id, newValue);
      }, 1500);
    },
    async handleDeletePerfume(id: number) {
      try {
        this.loading = true;
        await this.$axios.delete(`user/cart/${id}`);
        this.$store.dispatch("cart/handleDelete", id);
        successfulNotification(
          "Thành công",
          "Xóa sản phẩm khỏi giỏ hàng thành công!"
        );
      } catch (e) {
        failureNotification(
          "Lỗi",
          "Xóa sản phẩm khỏi giỏ hàng thất bại. Vui lòng thử lại."
        );
      } finally {
        this.loading = false;
      }
    },
    handleUpdate(id: number, quantity: number) {
      this.$axios.patch(`user/cart/${id}`, {
        quantity,
      });
    },
  },
});
</script>

<style lang="scss" scoped>
.row-sp {
  padding: 15px 0;
}
.btn-continue-shopping {
  width: 100%;
  background-color: var(--white);
  color: var(--green);
  border: 1px solid var(--green);
}
.cart-empty {
  max-width: 200px;
  margin: auto;
}
</style>
