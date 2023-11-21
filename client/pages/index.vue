<script lang="ts">
export default defineComponent({
  data() {
    return {};
  },
  mounted() {},
});
</script>

<template>
  <Head>
    <Title>Trang chủ</Title>
  </Head>
  <main style="margin-bottom: 100px" class="main-home">
    <v-carousel continuous cycle height="70vw" hide-delimiters>
      <v-carousel-item>
        <img src="~/assets/images/carousel/slider_1.webp" />
      </v-carousel-item>
      <v-carousel-item>
        <img src="~/assets/images/carousel/slider_2.webp" />
      </v-carousel-item>
      <v-carousel-item>
        <img src="~/assets/images/carousel/slider_3.webp" />
      </v-carousel-item>
    </v-carousel>
    <div class="container mt-4 ps-0 pe-0 border">
      <a
        class="card text-decoration-none"
        href="index.php?controller=nuochoa&action=sanpham&gioitinh=Nam"
      >
        <div class="card-body bg-success">
          <p class="card-text p-15-bold text-white">NƯỚC HOA NAM</p>
        </div>
        <div style="position: relative">
          <div class="box">
            <img
              src="~assets/images/nuocHoaNam/sec_group_product_banner_1.jpg"
              class=""
              alt="..."
            />
          </div>
        </div>
      </a>
      <div class="row ms-0 me-0">
        <v-sheet class="mx-auto container bg-white product p-0">
          <v-slide-group
            class="pa-4"
            selected-class="bg-success"
            show-arrows
          >
            <v-slide-group-item
              v-for="n in 15"
              :key="n"
              v-slot="{ isSelected, toggle, selectedClass }"
            >
              <v-card
                :class="['product-card', selectedClass]"
                height="400"
                width="250"
                @click="toggle"
              >
                <div class="d-flex fill-height align-center justify-center">
                  <v-scale-transition>
                    <v-icon
                      v-if="isSelected"
                      color="white"
                      size="48"
                      icon="mdi-close-circle-outline"
                    ></v-icon>
                  </v-scale-transition>
                </div>
              </v-card>
            </v-slide-group-item>
          </v-slide-group>
        </v-sheet>
      </div>
    </div>
  </main>
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
</style>
