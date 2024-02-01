<template>
  <v-navigation-drawer
    :model-value="show"
    class="sidebar"
    :expand-on-hover="expand_on_hover"
    :rail="rail"
    width="260"
    mobile-breakpoint="md"
    @update:model-value="handleDrawerUpdate"
    @update:rail="handleUpdateRail"
  >
    <NuxtLink to="/" class="p-2 d-flex justify-content-center pt-5 mt-1">
      <img
        :class="{ 'sidebar-logo': !rail, 'sidebar-logo__mini': rail }"
        src="/images/sidebar/logo.png"
        alt=""
      />
    </NuxtLink>
    <v-divider></v-divider>

    <v-list :opened="opened">
      <div v-for="(item, index) in navigation" :key="index">
        <v-list-item
          v-if="!item.hasOwnProperty('children')"
          :prepend-icon="item.icon.icon"
          :title="item.title"
          :to="item.to"
        ></v-list-item>
        <v-list-group v-else :value="item.title">
          <template v-slot:activator="{ props }">
            <v-list-item
              v-bind="props"
              :prepend-icon="item.icon.icon"
              :title="item.title"
            ></v-list-item>
          </template>
          <v-list-item
            v-for="(child, ind) in item.children"
            :prepend-icon="child.icon.icon"
            :title="child.title"
            :key="ind"
            :to="child.to"
          ></v-list-item>
        </v-list-group>
      </div>
    </v-list>
  </v-navigation-drawer>
</template>

<script lang="ts">
import navigation from "@config/navigation";
export default {
  setup() {
    return { navigation };
  },
  data() {
    return {
      opened: [],
      groupOpened: []
    };
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
    handleDrawerUpdate(): void {
      this.$emit("handleDrawerUpdate");
    },
    handleUpdateRail(value: boolean) {
      if (value) this.opened = []
    },
    handleUpdateOpen(value: any) {
      console.log(value);
    }
  },
  watch: {
    rail(newValue: boolean) {
      if (newValue) this.opened = []
    },
    groupOpened(newValue: Array<string>) {
      console.log(newValue);
    }
  },
};
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

.v-list-group__items .v-list-item {
  padding-inline-start: 42px !important;
}
</style>

<style>
.v-list-item {
  transition: 0.2s ease-in-out;
}
.v-list-item-title {
  font-size: 15px !important;
}
.v-list-item:hover {
  color: #bccee4;
  background: #3d4552;
  cursor: pointer;
}

.v-list-item__active {
  color: #bccee4 !important;
}
</style>
