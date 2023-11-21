<template>
  <v-navigation-drawer
    :model-value="show"
    class="sidebar"
    :expand-on-hover="expand_on_hover"
    :rail="rail"
    width="260"
    mobile-breakpoint
    @update:model-value="handleDrawerUpdate"
  >
    <div class="p-2 d-flex justify-content-center pt-5 mt-1">
      <img :class="{'sidebar-logo': !rail, 'sidebar-logo__mini': rail}" src="~/assets/images/sidebar/logo.png" alt="" />
    </div>
    <v-divider></v-divider>

    <v-list density="compact" nav>
      <v-list-item :active="$route.name === item.name" active-class="v-list-item__active" v-for="(item, index) in listItems" :prepend-icon="item.icon" :title="item.title" value="myfiles" :key="index"></v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script lang="ts">
export default defineComponent({
  data() {
    return {
      listItems: [
        {
          icon: "mdi-home",
          title: "Dashboard",
          name: "admin"
        },
        {
          icon: "mdi-information",
          title: "About",
          name: "about"
        }
      ]
    }
  },
  props: {
    expand_on_hover: {
      type: Boolean,
      default: false,
    },
    rail: {
      type: Boolean,
      default: false,
    },
    show: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    handleDrawerUpdate (): void {
      this.$emit('handleDrawerUpdate')
    }
  }
});
</script>

<style scoped>
.sidebar {
  background: #313a46;
  color: #98a6ad;
}
.sidebar-logo {
  height: 24px;
  width: auto;
  transition: 0.3s ease-in-out;
}

.sidebar-logo__mini {
  height: 12px;
  width: auto;
  transition: 0.3s ease-in-out;
}

.v-navigation-drawer--is-hovering .sidebar-logo__mini {
  height: 24px;
}
</style>

<style>
.v-list-item-title {
  font-size: 15px !important;
}
.v-list-item:hover {
  color: #bccee4;
}

.v-list-item__active {
  color: #bccee4 !important;
}
</style>
