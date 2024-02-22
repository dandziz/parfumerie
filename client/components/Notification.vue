<template>
  <AppNotifications
    position="bottom right"
    :speed="300"
    pauseOnHover
    closeOnClick
    class="custom-notification"
    :duration="800"
  >
    <template #body="props">
      <div :class='`vue-notification-template vue-notification ${props.item.type}`'>
        <div class="notification-title">
          {{ props.item.title }}
        </div>
        <div class="notification-content">
          {{ props.item.text }}
        </div>
        <Icon name="ic:round-close" size="24" class="close-notification" @click="props.close" />
      </div>
    </template>
  </AppNotifications>
</template>

<script>
export default {
  setup() {
    return {};
  },
};
</script>

<style lang="scss" scoped>
.vue-notification {
  position: relative;

  .close-notification {
    position: absolute;
    right: 8px;
    top: 8px;
    cursor: pointer;
  }
}
</style>
