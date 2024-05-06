<template>
  <v-card class="rounded-0">
    <div>
      <h1>Welcome to the adminpage</h1>
      <p>This is an auto-imported component</p>
    </div>
  </v-card>
</template>

<script lang="ts">
export default {
  setup() {
    definePageMeta({
      layout: 'admin',
      middleware: ["admin"]
    })
  }
}
</script>

<style lang="scss" scoped>

</style>
