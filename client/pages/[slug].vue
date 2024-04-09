<template>
  <div class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <v-dialog class="custom-modal" v-model="dialog" width="300">
      <div class="cart-notification-body">
        <img
          :src="
            statusAddCart
              ? '/images/ticket/check.png'
              : '/images/ticket/169779.png'
          "
          alt=""
        />
        <span class="p-14 text-white">
          {{
            statusAddCart
              ? "Đã thêm vào giỏ hàng thành công"
              : "Thêm vào giỏ hàng thất bại"
          }}</span
        >
      </div>
    </v-dialog>
    <div class="container">
      <div class="row border perfume-info mb-3">
        <div class="col-xs-12 col-lg-5 col-md-6 p-0">
          <Thumbnail :media="(perfume?.media as Array<Image>)" />
          <!-- (perfume?.media as Array<Image>) -->
        </div>
        <div class="col-xs-12 col-lg-7 col-md-6 details-pro ps-5">
          <div v-if="perfume">
            <h1 class="title-head">{{ perfume?.name }}</h1>
            <div class="vote">
              <Icon
                v-for="n in 5"
                name="material-symbols-light:star-outline"
                size="24px"
                class="text-warning rating-icon"
                :key="n"
              />
            </div>
            <p class="p-14-bold m-0">
              Tình trạng:
              <span class="fw-normal text-success">{{
                statusQuantity ? "Còn hàng" : "Hết hàng"
              }}</span>
            </p>
            <p class="price-information">{{ formatMoney(showPrice) }}</p>
            <p class="product_description text-greyish-blue">
              {{ perfume?.description }}
            </p>
            <div class="swatch">
              <p class="p-14-bold text-greyish-blue fw-bolder">Giới tính</p>
              <div class="swatch-element">
                <input
                  id="swatch-0-gender"
                  type="radio"
                  class="bk-product-property"
                  checked
                />
                <label
                  class="label-info border text-uppercase position-relative"
                  for="swatch-0-gender"
                  >{{ PerfumeGenderName[perfume?.gender ?? 0] }}</label
                >
              </div>
            </div>
            <div class="swatch">
              <p class="p-14-bold text-greyish-blue fw-bolder">Xuất xứ</p>
              <div class="swatch-element">
                <input
                  id="swatch-0-origin"
                  type="radio"
                  class="bk-product-property"
                  checked
                />
                <label
                  class="label-info border text-uppercase position-relative"
                  for="swatch-0-origin"
                  >{{ perfume?.origin }}</label
                >
              </div>
            </div>
            <div class="swatch">
              <p class="p-14-bold text-greyish-blue fw-bolder">Dung tích</p>
              <div class="d-flex">
                <div
                  class="swatch-element"
                  v-for="price in perfume?.price"
                  :key="price.id"
                >
                  <input
                    :id="`swatch-0-capacity-${price.id}`"
                    type="radio"
                    class="bk-product-property"
                    :disabled="!price.quantity"
                    :value="price.id"
                    v-model="pricePicked"
                  />
                  <label
                    class="label-info border text-uppercase position-relative"
                    :for="`swatch-0-capacity-${price.id}`"
                    >{{ price.capacity }}
                    <img
                      v-if="!price.quantity"
                      src="/images/ticket/soldout.png"
                      alt=""
                      class="w-100 h-100 label-soldout"
                  /></label>
                </div>
              </div>
            </div>
          </div>
          <ProductInformationLoading v-else></ProductInformationLoading>
          <div class="swatch pb-4">
            <p class="p-14-bold text-greyish-blue fw-bolder">Số lượng</p>
            <app-quantity-field size="large" v-model="quantity"></app-quantity-field>
          </div>
          <div v-if="!perfume || statusQuantity" class="swatch pb-1">
            <v-row>
              <v-col class="pt-0" cols="12" md="6">
                <button
                  class="btn btn-success btn-thongtin rounded-0 text-uppercase"
                  :disabled="!perfume"
                >
                  <span class="txt-main">Mua ngay</span>
                </button>
              </v-col>
              <v-col class="pt-0" cols="12" md="6">
                <button
                  class="btn btn-success btn-thongtin rounded-0 text-uppercase"
                  @click="handleAddPerfumeIntoCart"
                  :disabled="!perfume"
                >
                  <span class="txt-main">Thêm vào giỏ hàng</span>
                </button>
              </v-col>
            </v-row>
          </div>
          <div v-else>
            <div class="container p-0">
              <button
                class="btn btn-success btn-lg btn-thongtin rounded-0 d-flex flex-column justify-content-center align-items-center"
                disabled
                type="button"
              >
                <span class="txt-main text-uppercase">Hết hàng</span>
                <span class="p-14">Liên hệ 0888070308</span>
              </button>
            </div>
          </div>
          <div class="swatch">
            <button class="btn-favourite">
              <div><Icon name="ph:heart-fill" size="30" /></div>
              <span>Thêm vào yêu thích</span>
            </button>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-lg-9 col-left ps-0 border pe-0">
          <div class="padding-10 col-xs-12 col-lg-12">
            <ul class="product-tabs">
              <li
                class="tab tab-title text-uppercase"
                :class="{ active: currentTab == 1 }"
                @click="currentTab = 1"
              >
                Thông tin sản phẩm
              </li>
              <li
                class="tab tab-title text-uppercase"
                :class="{ active: currentTab == 2 }"
                @click="currentTab = 2"
              >
                Hướng dẫn sử dụng và bảo quản
              </li>
              <li
                class="tab tab-title text-uppercase"
                :class="{ active: currentTab == 3 }"
                @click="currentTab = 3"
              >
                Chính sách đổi trả và bảo hành
              </li>
              <li
                class="tab tab-title text-uppercase"
                :class="{ active: currentTab == 4 }"
                @click="currentTab = 4"
              >
                Đánh giá
              </li>
            </ul>
            <div class="tab-content" :key="currentTab" v-if="currentTab == 1">
              1
            </div>
            <div class="tab-content" :key="currentTab" v-if="currentTab == 2">
              <UserManual />
            </div>
            <div class="tab-content" :key="currentTab" v-if="currentTab == 3">
              <ReturnsAndWarranty />
            </div>
            <div class="tab-content" :key="currentTab" v-if="currentTab == 4">
              4
            </div>
          </div>
        </div>
        <div class="col-lg-3 border col-right">
          <div class="padding-top-10">
            <Information />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import type { Perfume, Image } from "~/models";
import type { RESPONSE_API_SUCCESS, RESPONSE_ERROR } from "~/types";
import { PerfumeGenderName } from "~/enums";
import ProductInformationLoading from "~/views/slug/ProductInformationLoading.vue";
import UserManual from "~/views/slug/UserManual.vue";
import ReturnsAndWarranty from "~/views/slug/ReturnsAndWarranty.vue";
import Information from "~/views/slug/Information.vue";
import { mapState } from "vuex";

export default {
  setup() {
    const route = useRoute();
    const slug = route.params?.slug;
    const perfume = ref<Perfume>();
    const timeoutId = ref<ReturnType<typeof setTimeout>>();
    useHead({
      title: "Nước hoa",
    });
    const config = useRuntimeConfig();
    return {
      slug,
      perfume,
      PerfumeGenderName,
      timeoutId,
    };
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/", name: "Nước hoa", active: true },
        { to: "/", name: "Nước hoa", active: true },
      ],
      statusQuantity: false,
      showPrice: 0,
      pricePicked: -1,
      quantity: 1,
      currentTab: 1,
      dialog: false,
      statusAddCart: false,
    };
  },
  components: {
    ProductInformationLoading,
    UserManual,
    ReturnsAndWarranty,
    Information,
  },
  mounted() {
    this.fetch();
  },
  computed: {
    ...mapState("user", ["user"]),
  },
  methods: {
    async fetch() {
      try {
        const response = await this.$axios.get<RESPONSE_API_SUCCESS<Perfume>>(
          `perfume/${this.slug}`
        );
        this.perfume = response.data.data;
        this.breadcrumbs[1].name = "Nước hoa " + this.perfume?.brand_name;
        this.breadcrumbs[2].name = "Nước hoa " + this.perfume?.name;
        this.perfume.price?.forEach((price, ind) => {
          if (ind == 0) this.showPrice = price.price as number;
          if (price.quantity && !this.statusQuantity) {
            this.statusQuantity = true;
            this.showPrice = price.price as number;
            this.pricePicked = price.id as number;
          }
        }) ?? false;
        document.title += " | " + this.perfume.name;
      } catch (e) {
        const error = e as RESPONSE_ERROR;
        console.log(error);
        
      }
    },
    async handleAddPerfumeIntoCart() {
      if (this.perfume && this.perfume.price && this.statusQuantity) {
        const price = this.perfume.price.filter(
          (value) => value.id == this.pricePicked
        )[0];
        const name = convertPerfumeName(
          this.perfume as Perfume,
          price.capacity
        );
        let cart = {
          name,
          quantity: this.quantity,
          perfume_id: this.perfume.id as number,
          price_id: price.id as number,
        };
        if (this.$ability.can("auth", "user")) {
          const dataCart = await addPerfumeIntoCart(cart);
          this.dialog = true;
          if (dataCart && dataCart != "failed") {
            this.$store.dispatch("cart/addPerfume", dataCart);
            this.statusAddCart = true;
          } else if (dataCart && dataCart == "failed") {
            this.statusAddCart = false;
          } else {
            this.$store.dispatch("cart/addPerfume", cart);
            this.statusAddCart = true;
          }
          this.timeoutId = setTimeout(() => {
            this.dialog = false;
          }, 1200);
        } else {
          this.$router.replace("/login");
        }
      }
    },
  },
  watch: {
    pricePicked(newValue) {
      this.perfume?.price?.forEach((price, ind) => {
        if (price.id == newValue) {
          this.showPrice = price.price as number;
        }
      });
    },
  },
};
</script>

<style lang="scss" scoped>
.perfume-info {
  padding: 10px;
}
.product_description {
  font-family: Trebuchet MS, Helvetica, sans-serif;
  text-align: justify;
}
.label-soldout {
  position: absolute;
  left: 0;
  top: 0;
}
.product-tabs {
  list-style: none inside;
  padding-left: 0;
  background-color: var(--green);
  color: var(--white);
  padding: 10px;
  margin-bottom: 20px;
  li.tab {
    display: inline-block;
    font-size: 14px;
    font-weight: 400;
    cursor: pointer;
    position: relative;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    &.active::after {
      position: absolute;
      content: "";
      width: 30px;
      height: 2.5px;
      background-color: var(--white);
      bottom: -4px;
      left: 50%;
      transform: translateX(-50%);
    }
  }
  li.tab:not(:first-child) {
    margin-left: 15px;
  }
  @media screen and (max-width: 1200px) and (min-width: 768px) {
    li.tab {
      font-size: 12px;
    }
  }
}
@media screen and (max-width: 480px) {
  .product-tabs {
    background-color: var(--white);
    color: var(--black);
    margin-bottom: 10px;
    padding: 0;
    li.tab {
      width: 100%;
      text-align: center;
      color: #2c2c43;
      padding: 5px;
      &.active {
        background-color: var(--green);
        color: var(--white);
        border-radius: 3px;
      }
      &.active::after {
        display: none;
      }
    }
    li.tab:not(:first-child) {
      margin-left: 0px;
    }
  }
}
</style>
