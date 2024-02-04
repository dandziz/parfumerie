<template>
  <div>
    <Button
      v-scroll="onScroll"
      v-show="fab"
      @click="toTop"
      class="scroll-to-top"
    >
      <Icon name="iconamoon:arrow-up-2-duotone" class="scroll-to-top-icon" size="24" />
    </Button>
  </div>
</template>

<script lang="ts">
import { useGoTo } from 'vuetify'
export default {
  data() {
    return {
      fab: false
    }
  },
  methods: {
    onScroll () {
      if (typeof window === 'undefined') return
      const top = window.scrollY || 0
      this.fab = top > 200
    },
    toTop () {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    }
  },
};
</script>

<style lang="scss" scoped>
.scroll-to-top {
  z-index: 1500;
  height: 50px !important;
  width: 50px !important;
  border-radius: 100% !important;
  background-color: rgb(24, 103, 192);
  position: fixed;
  right: 15px;
  bottom: 15px;
  &:hover {
    opacity: 0.8;
  }
  .scroll-to-top-icon {
    transform: translateY(-2px);
  }
  
}
</style>
