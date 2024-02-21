<template>
  <v-card title="Quản lý giá nước hoa" class="position-relative">
    <VOverlay class="component-overlay" persistent contained v-model="loading">
      <VProgressCircular
        indeterminate
        color="primary"
        :width="2"
        :size="50"
        class="text-success"
      />
    </VOverlay>
    <v-card-item>
      
    </v-card-item>
  </v-card>
</template>

<script>
export default {
  setup() {
    return {};
  },
};
</script>

<style lang="scss" scoped></style>
