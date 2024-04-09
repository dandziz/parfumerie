<template>
  <div v-if="$ability.can('auth', 'user')" class="my-cart-body text-black p-14">
    <div class="cart-wrapper padding-10 m-0">
      <div v-if="carts.length == 0" class="no-item">
        <p>Không có sản phẩm nào trong giỏ hàng.</p>
      </div>
      <div v-else></div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { mapState } from "vuex";

export default defineComponent({
  setup () {
    return {
    }
  },
  mounted () {
  },
  computed: {
    ...mapState("cart", ["carts"]),
  },
})
</script>

<style lang="scss">
.my-cart-body {
  position: absolute;
  right: 0;
  top: 54px;
  text-align: left;
  box-shadow: 0 0 15px -5px rgba(0,0,0,0.4);
  padding: 0;
  z-index: 10000;
  background-color: var(--white);
  line-height: 1.7;
  display: none;
}
.cart-wrapper {
  max-height: 582px;
  min-width: 320px;
  .no-item {
    p {
      margin: 0;
    }
  }
}
</style>
