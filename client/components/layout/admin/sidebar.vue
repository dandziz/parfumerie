<template>
  <v-navigation-drawer
    :model-value="show"
    class="sidebar"
    :expand-on-hover="expand_on_hover"
    :rail="rail"
    width="260"
    mobile-breakpoint="md"
    @update:model-value="handleDrawerUpdate"
  >
    <div class="p-2 d-flex justify-content-center pt-5 mt-1">
      <img
        :class="{ 'sidebar-logo': !rail, 'sidebar-logo__mini': rail }"
        src="/images/sidebar/logo.png"
        alt=""
      />
    </div>
    <v-divider></v-divider>
    
    <v-list v-model:opened="open">
      <v-list-item prepend-icon="mdi-home-outline" title="Dashboard"></v-list-item>

      <v-list-group value="Users">
        <template v-slot:activator="{ props }">
          <v-list-item
            v-bind="props"
            prepend-icon="mdi-account-circle-outline"
            title="Users"
          ></v-list-item>
        </template>

        <v-list-item prepend-icon="mdi-format-list-bulleted-square" title="User List"></v-list-item>
        <v-list-item prepend-icon="mdi-account-plus-outline" title="Create New User"></v-list-item>
      </v-list-group>

      <v-list-group value="Perfumes">
        <template v-slot:activator="{ props }">
          <v-list-item
            v-bind="props"
            prepend-icon="mdi-account-circle-outline"
            title="Perfumes"
          ></v-list-item>
        </template>

        <v-list-item prepend-icon="mdi-format-list-bulleted-square" title="Perfumes List"></v-list-item>
        <v-list-item prepend-icon="mdi-account-plus-outline" title="Create New Perfume"></v-list-item>
      </v-list-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script lang="ts">
export default {
  data() {
    return {
      listItems: [
        {
          title: "Dashboard",
          children: [
            {
              icon: "mdi-home",
              title: "Dashboard",
              name: "admin",
            },
            {
              icon: "mdi-information",
              title: "User",
              name: "User",
              children: [
                {
                  icon: "mdi-information",
                  title: "List Of Users",
                  name: "User List",
                },
                {
                  icon: "mdi-information",
                  title: "Create New User",
                  name: "Create User",
                },
              ],
            },
          ],
        },
      ],
      open: ["Users"],
      admins: [
        ["Management", "mdi-account-multiple-outline"],
        ["Settings", "mdi-cog-outline"],
      ],
      cruds: [
        ["Create", "mdi-plus-outline"],
        ["Read", "mdi-file-outline"],
        ["Update", "mdi-update"],
        ["Delete", "mdi-delete"],
      ],
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
  background: #3D4552;
  cursor: pointer;
}

.v-list-item__active {
  color: #bccee4 !important;
}
</style>
