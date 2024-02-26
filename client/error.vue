<template>
  <div class="error-wrapper">
    <div class="error-container">
      <img src="/images/404-error.png" alt="">
      <h6 class="text-uppercase mt-4 text-center">{{ message.title }}</h6>
      <v-btn to="/" class="bg-primary" prepend-icon="mdi mdi-home-export-outline">QUAY LẠI TRANG CHỦ</v-btn>
    </div>
  </div>
</template>

<script lang="ts" setup>
const error = useError();
const messages = {
  "404": { title: "Không tìm thấy trang bạn yêu cầu!", link: "/images/404-error.png" },
  "500": { title: "Hệ thống bị lỗi. Vui lòng thử lại sau!", link: "/images/404-error.png" },
  "401": { title: "Bạn không có quyền truy cập!", link: "/images/404-error.png" },
  "400": { title: "Bad Request!", link: "/images/404-error.png" },
}
type MESSAGES = typeof messages
const message = messages[error.value?.statusCode?.toString() as keyof MESSAGES]
</script>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  
})
</script>

<style lang="scss" scoped>
.error-wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  width: 100vw;
  .error-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    width: 50%;
    img {
      width: 30%;
      height: auto;
    }
  }
}
@media screen and (max-width: 468px) {
  .error-wrapper {
    .error-container {
      width: 80%;
      img {
        width: 40%;
      }
    }
  }
}
</style>
