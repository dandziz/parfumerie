<template>
  <v-card class="rounded-0">
    <div>
      <h1>Welcome to the adminpage</h1>
      <p>This is an auto-imported component</p>
    </div>
  </v-card>
</template>

<script setup lang="ts">
definePageMeta({
  layout: 'admin',
  middleware: ["admin"]
})
</script>

<script lang="ts">
export default {
  
}
</script>

<style lang="scss" scoped>

</style>
