<template>
  <div class="my-cart-body">
    <p>Không có sản phẩm nào trong giỏ hàng.</p>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import { mapState } from "vuex";
import AxiosRepository from '../../../httpRequest/AxiosRepository'

export default defineComponent({
  setup () {
    const axios = new AxiosRepository()
    return {
      axios
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
}
</style>
