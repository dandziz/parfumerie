<template>
  <div class="sidebar" :class="{'active': activeSidebar}">
    <Backdrop v-if="activeSidebar" @clickBackdrop="handleClickBackdrop" />
    <Icon
      name="material-symbols-light:close"
      class="sidebar-close"
      size="32px"
      @click="handleClickBackdrop"
    />
    <div class="sidebar-info">
      <div class="sidebar-avatar">
        <div><Icon name="teenyicons:user-circle-solid" size="30px" /></div>
      </div>
      <div class="text-center text-white username">Xin chào</div>
      <div class="sidebar-navigation">
        <OutlineButton
          componentType="link"
          class="sidebar-navigation__button p-14 text-uppercase text-white"
          to="/login"
          @click="handleClickBackdrop"
          >Đăng nhập</OutlineButton
        >
        <OutlineButton
          componentType="link"
          class="sidebar-navigation__button p-14 text-uppercase text-white"
          to="/register"
          @click="handleClickBackdrop"
          >Đăng ký</OutlineButton
        >
      </div>
    </div>
    <div class="sidebar-list">
      <div class="p-13 sidebar-category">Danh mục</div>
      <div class="sidebar-content">
        <div class="sidebar-item"><NuxtLink>Trang chủ</NuxtLink></div>
        <div class="sidebar-item"><NuxtLink>Giới thiệu</NuxtLink></div>
        <v-expansion-panels class="sidebar-expan">
          <v-expansion-panel>
            <v-expansion-panel-title
              expand-icon="mdi-plus"
              collapse-icon="mdi-minus"
            >
              Thương hiệu
            </v-expansion-panel-title>
            <v-expansion-panel-text>
              <ul>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
              </ul>
            </v-expansion-panel-text>
          </v-expansion-panel>
        </v-expansion-panels>
        <v-expansion-panels class="sidebar-expan">
          <v-expansion-panel>
            <v-expansion-panel-title
              expand-icon="mdi-plus"
              collapse-icon="mdi-minus"
            >
              Thương hiệu
            </v-expansion-panel-title>
            <v-expansion-panel-text>
              <ul>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
                <li>A mu ra</li>
                <li>Nẹt bô</li>
              </ul>
            </v-expansion-panel-text>
          </v-expansion-panel>
        </v-expansion-panels>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex'
export default {
  data() {
    return {
      windowWidth: window.innerWidth,
    }
  },
  props: {
    activeSidebar: {
      type: Boolean,
      default: false,
    }
  },
  mounted () {
    window.addEventListener('resize', this.handleResize);
  },
  destroyed() {
    window.removeEventListener('resize', this.handleResize);
  },
  computed: {
    ...mapState("brand", ["brands"]),
  },
  methods: {
    handleResize() {
      this.windowWidth = window.innerWidth;
      if (this.windowWidth >= 992) {
        this.$emit('unactiveSidebar')
      }
    },
    handleClickBackdrop() {
      this.$emit('unactiveSidebar')
    }
  }
}
</script>

<style lang="scss">
.sidebar-expan {
  .v-expansion-panel__shadow {
    box-shadow: none !important;
  }
  .v-expansion-panel-title {
    font-size: 14px;
    padding: 10px 20px 10px 5px;
    min-height: 41.8px !important;
    .v-expansion-panel-title__overlay {
      background: #fff;
      border-radius: 0;
    }
  }
  .v-expansion-panel-title:hover {
    opacity: 1 !important;
  }
  ul {
    list-style-type: none;
    padding-left: 0;
    li {
      padding: 10px 20px 10px 5px;
    }
  }
  .v-expansion-panel-text__wrapper {
    padding: 10px 20px 10px 10px;
  }
}
</style>
