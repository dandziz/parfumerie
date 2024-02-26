<template>
  <div class="card rounded-0 pduct">
    <NuxtLink class="product-link" :to="$attrs.link">
      <img class="product-img" :src="imageLink" alt="" />
    </NuxtLink>
    <div class="card-body">
      <NuxtLink :to="$attrs.link">
        <p class="card-text p-14-bold title-product text-black">
          {{ tenNuocHoa }}
        </p>
      </NuxtLink>
      <div class="vote">
        <Icon
          v-for="n in 5"
          name="material-symbols-light:star-outline"
          size="24px"
          class="text-warning rating-icon"
          :key="n"
        />
      </div>
      <div class="product-footer">
        <div class="product-price p-14-bold text-success">{{ giaNuocHoa }}</div>
        <div class="product-menu hidden-menu">
          <NuxtLink :to="$attrs.link">
            <AppButton class="btn-menu">
              <Icon name="fa:cart-plus" color="white" size="17px" />
            </AppButton>
          </NuxtLink>
          <div>
            <AppButton class="btn-menu xemThongTin">
              <Icon name="fa:eye" color="white" size="17px" />
            </AppButton>
          </div>
          <div>
            <AppButton class="btn-menu addYeuThich" type="button">
              <Icon name="ph:heart-bold" color="white" size="17px" />
            </AppButton>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    imageLink: {
      type: String,
      required: true,
    },
    tenNuocHoa: {
      type: String,
      required: true,
    },
    giaNuocHoa: {
      type: String,
      required: true,
    },
  },
};
</script>

<style lang="scss">
.btn-menu {
  padding: 1.45px 5.7px;
  display: flex;
  align-content: center;
  justify-content: center;
  svg {
    line-height: 30px;
    padding-top: 4.75px;
    padding-bottom: 4.75px;
  }
  &:hover svg {
    color: white !important;
  }
}
.rating-icon {
  transform: translateX(-4.44px);
}
.product-footer {
  height: 49px;
}
</style>
