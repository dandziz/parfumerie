<script lang="ts">
import { Pagination, Navigation, Grid } from "swiper/modules";

export default {
  components: {},
  setup() {
    return {
      modules: [Navigation, Pagination],
    };
  },
  data() {
    return {};
  },
  mounted() {},
};
</script>

<template>
  <div>
    <Head>
      <Title>Trang chủ</Title>
    </Head>
    <main style="margin-bottom: 100px" class="main-home">
      <v-carousel continuous cycle height="70vw" hide-delimiters>
        <v-carousel-item>
          <img src="/images/carousel/slider_1.webp" />
        </v-carousel-item>
        <v-carousel-item>
          <img src="/images/carousel/slider_2.webp" />
        </v-carousel-item>
        <v-carousel-item>
          <img src="/images/carousel/slider_3.webp" />
        </v-carousel-item>
      </v-carousel>
      <div class="container mt-4 ps-0 pe-0 border">
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
          <v-sheet class="mx-auto container bg-white product p-0">
            <swiper
              :slidesPerView="3"
              :navigation="true"
              :spaceBetween="30"
              :modules="modules"
              class="mySwiper"
            >
              <swiper-slide>Slide 1</swiper-slide>
              <swiper-slide>Slide 2</swiper-slide
              ><swiper-slide>Slide 3</swiper-slide>
              <swiper-slide>Slide 4</swiper-slide
              ><swiper-slide>Slide 5</swiper-slide>
              <swiper-slide>Slide 6</swiper-slide
              ><swiper-slide>Slide 7</swiper-slide>
              <swiper-slide>Slide 8</swiper-slide
              ><swiper-slide>Slide 9</swiper-slide>
            </swiper>
          </v-sheet>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.v-carousel img {
  object-fit: cover;
}
.product {
  box-shadow: none !important;
}
.v-slide-group {
  padding: 0 !important;
}

.product-card {
  border-radius: 0;
}
.swiper-slide {
  height: 100px;
}
</style>
