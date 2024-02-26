<template>
  <div>

  </div>
</template>

<script>
export default {
  setup () {
    const route = useRoute()
    definePageMeta({
      middleware: ["customer"]
    })

    return {}
  }
}
</script>

<style lang="scss" scoped>

</style>
