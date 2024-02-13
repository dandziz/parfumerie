<template>
  <div class="card-wrapper swiper-wrapper">
    <NuxtLink
      class="card-container swiper-slide text-decoration-none text-dark text-start" :to="link"
    >
      <div class="image-content">
        <span class="overlay"></span>
        <div class="card-image">
          <img alt="" :src="imageLink" class="card-img img-thongtin" />
        </div>
      </div>
      <div class="card-content d-flex flex-column justify-content-start mt-2">
        <p class="card-title p-14-bold text-justify">{{ title }}</p>
        <span class="card-time p-12 ms-0 me-0 mt-2 text-opacity-50"
          >Đăng bởi <span class="fw-bold">PARFUMERIEVN</span> - {{ time }}
        </span>
        <p class="p-12 mt-2 text-justify" data-toggle="tooltip" title="">{{ description }}</p>
      </div>
    </NuxtLink>
  </div>
</template>

<script lang="ts">
export default {
  data() {
    return {

    }
  },
  props: {
    imageLink: {
      type: String,
      required: true,
    },
    link: {
      type: String,
      default: "",
    },
    title: {
      type: String,
      required: true,
    },
    time: {
      type: String,
      required: true,
    },
    description: {
      type: String,
      required: true,
    },
  },
};
</script>

<style>
.img-thongtin {
  width: 100%;
  height: 149px;
  object-fit: cover;
}
.card-time {
  opacity: 0.7;
}
</style>
