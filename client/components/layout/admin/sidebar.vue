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
        src="~/assets/images/sidebar/logo.png"
        alt=""
      />
    </div>
    <v-divider></v-divider>

    <v-list
      v-for="(items, index) in listItems"
      :class="{ 'p-3': !expand_on_hover }"
      density="compact"
      :key="index"
      nav
    >
      <p v-if="!expand_on_hover" class="text-subtitle-2 text-uppercase">
        {{ items.title }}
      </p>
      <template v-for="(item, ind) in items.children" :key="ind">
        <v-list-item
          v-if="!item.children"
          :active="$route.name === item.name"
          active-class="v-list-item__active"
          :prepend-icon="item.icon"
          :title="item.title"
          value="myfiles"
        ></v-list-item>
        <v-list-group :title="item.title" v-else :prepend-icon="item.icon">
          <v-list-item>OK</v-list-item>
        </v-list-group>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script lang="ts">
export default defineComponent({
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
