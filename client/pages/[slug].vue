<template>
  <div class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="container">
      <div class="row perfume-info border mb-3">
        <div class="col-xs-12 col-sm-6 col-lg-5 col-md-6 p-0">
          <Thumbnail :media="(perfume?.media as Array<Image>)" />
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-7 col-md-6 details-pro ps-5">
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
            Tình trạng: <span class="fw-normal text-success">{{ status ? 'Còn hàng' : 'Hết hàng' }}</span>
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
              <div class="swatch-element" v-for="price in perfume?.price" :key="price.id">
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
                <img v-if="!price.quantity" src="/images/ticket/soldout.png" alt="" class="w-100 h-100 label-soldout"></label>
              </div>
            </div>
          </div>
          <div class="swatch">
            <p class="p-14-bold text-greyish-blue fw-bolder">Số lượng</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import type { Perfume, Image } from "~/models";
import type { RESPONSE_API_SUCCESS } from "~/types";
import { PerfumeGenderName } from "~/enums";

export default {
  setup() {
    const route = useRoute();
    const slug = route.params?.slug;
    const perfume = ref<Perfume>();

    return {
      slug,
      perfume,
      PerfumeGenderName,
    };
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/", name: "Nước hoa", active: true },
        { to: "/", name: "Nước hoa", active: true },
      ],
      status: false,
      showPrice: 0,
      pricePicked: -1,
    };
  },
  mounted() {
    this.fetch();
  },
  computed: {},
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
          if (ind == 0) this.showPrice = price.price as number
          if (price.quantity && !this.status) {
            this.status = true
            this.showPrice = price.price as number
            this.pricePicked = price.id as number
          }
        }) ?? false
      } catch (e) {}
    },
  },
  watch: {
    pricePicked(newValue) {
      this.perfume?.price?.forEach((price, ind) => {
        if (price.id == newValue) {
          this.showPrice = price.price as number
        }
      })
    }
  }
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
</style>
