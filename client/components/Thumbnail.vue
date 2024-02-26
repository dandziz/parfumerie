<template>
  <div>
    <swiper
      :style="{
        '--swiper-navigation-color': '#fff',
        '--swiper-pagination-color': '#fff',
      }"
      :loop="true"
      :spaceBetween="10"
      :thumbs="{ swiper: thumbsSwiper }"
      :modules="modules"
      class="main-thumbnail"
    >
      <swiper-slide v-if="media" v-for="item in media" :key="item.id"
        ><img :src="item.img_link"
      /></swiper-slide>
    </swiper>
    <swiper
      @swiper="setThumbsSwiper"
      :loop="true"
      :spaceBetween="5"
      :slidesPerView="4"
      :modules="modules"
      :navigation="true"
      class="img-thumbnail"
    >
      <swiper-slide v-if="media" v-for="item in media" :key="item.id"
        ><img :src="item.thumb_link"
      /></swiper-slide>
    </swiper>
  </div>
</template>

<script lang="ts">
import { FreeMode, Navigation, Thumbs } from "swiper/modules";
import type { Image } from "~/models";
export default {
  setup() {
    const thumbsSwiper = ref();

    const setThumbsSwiper = (swiper: any) => {
      thumbsSwiper.value = swiper;
    };

    return {
      thumbsSwiper,
      setThumbsSwiper,
      modules: [FreeMode, Navigation, Thumbs],
    };
  },
  props: {
    media: {
      type: Array<Image>,
      required: false,
    },
  },
};
</script>

<style lang="scss" scoped>
/* Thumbnail */
.main-thumbnail {
  img {
    max-width: 100%;
    height: auto;
    border-radius: 2px;
  }
}
.img-thumbnail {
  border-radius: 0;
  .swiper-slide {
    border: 1px solid #f5f5f5;
    height: 84px;
    img {
      padding: 6px 10px 6px;
      border-radius: 2px;
      max-height: 72px;
      width: auto;
      object-fit: cover;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }
  }
}
/* End Thumbnail */
</style>
