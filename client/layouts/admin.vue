<template>
  <div class="admin-layout rounded-0">
    <v-layout>
      <LayoutAdminSidebar
        :show="show"
        :expand_on_hover="expand_on_hover"
        :rail="rail"
        @handleDrawerUpdate="handleDrawerUpdate"
      />
      <v-main style="height: 250px; position: relative">
        <LayoutAdminHeader @toggleSidebar="toggleSidebar" />
        <div class="p-3 admin-content">
          <slot></slot>
        </div>
      </v-main>
    </v-layout>
  </div>
</template>

<script lang="ts">
export default defineComponent({
  data() {
    return {
      expand_on_hover: false,
      rail: false,
      show: false,
    };
  },
  mounted() {
    if (this.$vuetify.display.width < 1280) {
      this.show = false;
      this.expand_on_hover = false;
      this.rail = false;
    } else {
      this.show = true;
    }
  },
  methods: {
    toggleSidebar(): void {
      if (this.show) {
        if (this.expand_on_hover === false && this.rail === false && this.$vuetify.display.width > 1280) {
          this.expand_on_hover = true
          this.rail = true
        } else {
          this.show = false
          this.expand_on_hover = false
          this.rail = false
        }
      } else {
        this.show = true
      }
    },
    handleDrawerUpdate(): void {
      this.toggleSidebar()
    },
  },
});
</script>

<style scoped>
.admin-layout {
  font-family: Nunito, sans-serif;
}
.v-main {
  background-color: #fafbfe;
}
</style>
