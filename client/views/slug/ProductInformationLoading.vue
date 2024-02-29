<template>
  <div>
    <h1 class="title-head">
      <v-skeleton-loader class="skeleton-custom margin-0" type="subtitle" />
    </h1>
    <div class="vote mt-1">
      <Icon
        v-for="n in 5"
        name="material-symbols-light:star-outline"
        size="24px"
        class="text-warning rating-icon"
        :key="n"
      />
    </div>
    <p class="p-14-bold m-0">
      <v-skeleton-loader class="skeleton-custom margin-0" type="subtitle" />
    </p>
    <p class="p-14-bold m-0 mt-3">
      <v-skeleton-loader class="skeleton-custom margin-0" type="subtitle" />
    </p>
    <p class="p-14-bold m-0 mt-5">
      <v-skeleton-loader class="skeleton-custom margin-0 mb-3" type="text" />
      <v-skeleton-loader class="skeleton-custom margin-0 mb-3" type="text" />
      <v-skeleton-loader class="skeleton-custom margin-0" type="text" />
    </p>
    <div class="swatch">
      <p class="p-14-bold text-greyish-blue fw-bolder">Giới tính</p>
      <div class="swatch-element">
        <v-skeleton-loader class="skeleton-custom margin-0 pt-2" type="text" />
      </div>
    </div>
    <div class="swatch">
      <p class="p-14-bold text-greyish-blue fw-bolder">Xuất xứ</p>
      <div class="swatch-element">
        <v-skeleton-loader class="skeleton-custom margin-0 pt-2" type="text" />
      </div>
    </div>
    <div class="swatch">
      <p class="p-14-bold text-greyish-blue fw-bolder">Dung tích</p>
      <div class="d-flex">
        <div class="swatch-element" v-for="item in price" :key="item.id">
          <input
            :id="`swatch-0-capacity-${item.id}`"
            type="radio"
            class="bk-product-property"
            :disabled="!item.quantity"
            :value="item.id"
          />
          <label
            class="label-info border text-uppercase position-relative"
            :for="`swatch-0-capacity-${item.id}`"
            >{{ item.capacity }}
            <img
              v-if="!item.quantity"
              src="/images/ticket/soldout.png"
              alt=""
              class="w-100 h-100 label-soldout"
          /></label>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  setup() {
    return {};
  },
  data() {
    return {
      price: [
        { id: 1, capacity: "CHIẾT 10ML", quantity: true },
        { id: 2, capacity: "CHIẾT 20ML", quantity: true },
        { id: 3, capacity: "FULLBOX 100ML", quantity: true },
      ],
    };
  },
});
</script>

<style scoped></style>
