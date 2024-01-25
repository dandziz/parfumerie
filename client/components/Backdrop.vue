<template>
  <Teleport to="html">
    <div class="backdrop" @click="handleClickBackdrop"></div>
  </Teleport>
</template>

<script>
export default {
  emits: ["clickBackdrop"],
  methods: {
    handleClickBackdrop() {
      this.$emit('clickBackdrop')
    }
  }
}
</script>

<style>
.backdrop {
  width: 100vw;
  height: 100vh;
  position: absolute;
  background-color: rgba(0,0,0,0.55);
  z-index: 100;
  top: 0;
  left: 0;
}
</style>
