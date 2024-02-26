<template>
  <div>
    <Head>
      <Title>Trang chủ</Title>
    </Head>
    <!-- Slider -->
    <swiper
      :slidesPerView="1"
      :spaceBetween="30"
      :modules="modules"
      :loop="true"
      :pagination="{
        clickable: true,
      }"
      class="mySwiper"
      :autoplay="{
        delay: 4000,
        disableOnInteraction: false,
      }"
    >
      <swiper-slide
        ><NuxtLink to="/"
          ><img
            class="slider"
            src="/images/carousel/slider_1.jpg"
            alt="" /></NuxtLink
      ></swiper-slide>
      <swiper-slide
        ><NuxtLink to="/"
          ><img
            class="slider"
            src="/images/carousel/slider_2.jpg"
            alt="" /></NuxtLink
      ></swiper-slide>
      <swiper-slide
        ><NuxtLink to="/"
          ><img
            class="slider"
            src="/images/carousel/slider_3.jpg"
            alt="" /></NuxtLink
      ></swiper-slide>
      <swiper-slide
        ><NuxtLink to="/"
          ><img
            class="slider"
            src="/images/carousel/slider_4.jpg"
            alt="" /></NuxtLink
      ></swiper-slide>
    </swiper>
    <!-- Male -->
    <div class="container product-container mt-4 ps-0 pe-0 border">
      <a class="card text-decoration-none">
        <div class="card-body bg-success">
          <p class="card-text p-15-bold text-white">NƯỚC HOA NAM</p>
        </div>
        <div>
          <div class="box">
            <img
              src="/images/male/sec_group_product_banner_1.jpg"
              class=""
              alt="..."
            />
          </div>
        </div>
      </a>
      <div class="row ms-0 me-0">
        <div class="product-wrap">
          <v-sheet class="mx-auto container bg-white product p-0">
            <swiper
              :slidesPerView="numberSliders"
              :navigation="true"
              :spaceBetween="0"
              :modules="modules"
              class="maleSlider"
            >
              <swiper-slide
                v-if="perfumes.length > 0"
                v-for="item in perfumes"
                :key="item[0].id"
              >
                <div class="carp-wrap">
                  <ParfumerieCard
                    :link="{ name: 'slug', params: { slug: item[0].slug } }"
                    :imageLink="item[0].avatar"
                    :tenNuocHoa="item[0].name"
                    :giaNuocHoa="item[0].display_price"
                  />
                </div>
                <div class="carp-wrap">
                  <ParfumerieCard
                    :link="{ name: 'slug', params: { slug: item[1].slug } }"
                    :imageLink="item[1].avatar"
                    :tenNuocHoa="item[1].name"
                    :giaNuocHoa="item[1].display_price"
                  />
                </div>
              </swiper-slide>
              <swiper-slide v-else v-for="n in 5" :key="n">
                <v-skeleton-loader
                  class="mx-auto border rounded-0"
                  max-width="300"
                  type="image, article"
                ></v-skeleton-loader>
                <v-skeleton-loader
                  class="mx-auto border rounded-0"
                  max-width="300"
                  type="image, article"
                ></v-skeleton-loader>
              </swiper-slide>
            </swiper>
          </v-sheet>
          <div class="show-all d-flex justify-content-center">
            <AppButton
              bg="btn-success"
              class="p-14 d-flex align-items-center gap-1"
            >
              <Icon name="fa:hand-o-right" size="14px" />
              Xem tất cả
            </AppButton>
          </div>
        </div>
      </div>
    </div>

    <!-- Female -->

    <!-- Unisex -->

    <!-- Information -->
    <div class="container info-container mt-5 bg-white">
      <div class="d-flex justify-content-center">
        <h4 class="mt-2 info-header">THÔNG TIN</h4>
      </div>
      <div class="bd-container mt-3 bg-white">
        <v-sheet class="mx-auto container info-wrap bg-white p-0">
          <swiper
            :slidesPerView="numberInformations"
            :navigation="true"
            :spaceBetween="15"
            :modules="modules"
            class="maleSlider"
          >
            <swiper-slide v-for="n in 10" :key="n">
              <div class="carp-wrap">
                <InformationCard
                  link=""
                  imageLink="/images/information/nuoc-hoa-chiet-parfumerie-vn.jpg"
                  title="Bảng giá nước hoa Bleu Chanel EDP cập nhật mới nhất vào tháng 01/2024"
                  time="28/12/2023"
                  description="Nhắc đến những chai nước hoa nhận được nhiều lời khen và sự yêu thích thì không thể bỏ qua Baccar..."
                />
              </div>
            </swiper-slide>
          </swiper>
        </v-sheet>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { Pagination, Navigation, Autoplay } from "swiper/modules";
import type { Perfume } from "~/models";
import type { RESPONSE_API_SUCCESS } from "~/types";
export default {
  setup() {
    const perfumes = ref<Perfume[][]>([]);
    return {
      modules: [Autoplay, Navigation, Pagination],
      perfumes,
    };
  },
  data() {
    return {};
  },
  mounted() {
    this.fetch();
  },
  computed: {
    numberSliders(): number {
      if (this.$vuetify.display.width >= 992) {
        return 5;
      } else if (
        this.$vuetify.display.width < 992 &&
        this.$vuetify.display.width >= 768
      ) {
        return 4;
      } else if (
        this.$vuetify.display.width < 768 &&
        this.$vuetify.display.width >= 543
      ) {
        return 3;
      } else {
        return 2;
      }
    },
    numberInformations(): number {
      if (this.$vuetify.display.width >= 992) {
        return 4;
      } else if (
        this.$vuetify.display.width < 992 &&
        this.$vuetify.display.width >= 768
      ) {
        return 3;
      } else if (
        this.$vuetify.display.width < 768 &&
        this.$vuetify.display.width >= 543
      ) {
        return 2;
      } else {
        return 1;
      }
    },
  },
  methods: {
    async fetch() {
      try {
        const response = await this.$axios.get<RESPONSE_API_SUCCESS<Perfume[]>>(
          "perfumes"
        );
        const data = response.data.data
        for(let i = 0; i < data.length; i+=2) {
          this.perfumes.push([data[i], data[i+1]])
        }
      } catch (e) {}
    },
  },
};
</script>

<style lang="scss">
.slider {
  width: 100%;
  height: auto;
  object-fit: cover !important;
}
.product-wrap {
  padding: 0;
  .show-all {
    border-left: 1px solid #e5e5e5 !important;
    border-bottom: 1px solid #e5e5e5 !important;
    border-right: 1px solid #e5e5e5 !important;
    .btn {
      padding: 3px 8.2px;
    }
  }
}
.product {
  border-left: 1px solid #e5e5e5 !important;
  border-top: 1px solid #e5e5e5 !important;
  .carp-wrap {
    border-right: 1px solid #e5e5e5 !important;
    border-bottom: 1px solid #e5e5e5 !important;
  }
}
.swiper-slide {
  .product-img {
    display: block;
    width: auto;
    height: 100%;
    object-fit: scale-down;
    object-position: center;
  }
  .card {
    border-width: 0;
    .card-body {
      padding: 0 5px 0 5px;
    }
  }
}
.product-container,
.info-container {
  border-width: 0 !important;
  margin-bottom: 15px;
}

.info-container {
  min-height: 380px;
  .info-header {
    position: relative;
    font-size: 20px;
    &::after {
      content: "";
      position: absolute;
      height: 2px;
      width: 90%;
      left: 50%;
      transform: translateX(-50%);
      bottom: -5px;
      background: var(--light-green);
    }
  }
}
</style>
