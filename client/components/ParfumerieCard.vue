<template>
  <div class="card rounded-0 pduct">
    <NuxtLink class="product-link" :to="link">
      <img class="product-img" :src="imageLink" alt="" />
    </NuxtLink>
    <div class="card-body">
      <NuxtLink :to="link">
        <p class="card-text p-14-bold title-product text-black">
          {{ tenNuocHoa }}
        </p>
      </NuxtLink>
      <div class="vote">
        <Icon
          v-for="n in 5"
          name="material-symbols-light:star-outline"
          size="24px"
          class="text-warning"
          :key="n"
        />
      </div>
      <div>
        <div class="product-price p-14-bold text-success">{{ giaNuocHoa }}</div>
        <div class="product-menu hidden-menu">
          <NuxtLink :to="link">
            <button class="btn-menu">
              <Icon name="fa:cart-plus" class="text-success" size="17px" />
            </button>
          </NuxtLink>
          <div>
            <button class="btn-menu xemThongTin">
              <Icon name="fa:eye" class="text-success" size="17px" />
            </button>
          </div>
          <div>
            <button class="btn-menu addYeuThich" type="button">
              <Icon name="ph:heart-light" class="text-success" size="17px" />
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    link: {
      type: String,
      require: true,
      default: "",
    },
    imageLink: {
      type: String,
      require: true,
      default: "/",
    },
    tenNuocHoa: {
      type: String,
      require: true,
      default: "",
    },
    giaNuocHoa: {
      type: String,
      require: true,
      default: "",
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
</style>
