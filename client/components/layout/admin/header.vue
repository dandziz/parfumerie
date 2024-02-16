<template>
  <div>
    <div class="admin-header text-black">
      <div class="left-header">
        <Icon
          name="ic:baseline-menu"
          class="cursor-pointer"
          size="24"
          @click="handleToggleSidebar"
        />
      </div>
      <div class="right-header">
        <Icon
          class="me-3 cursor-pointer"
          size="28"
          name="material-symbols:notifications-unread-outline-rounded"
        />
        <Icon
          class="me-3 cursor-pointer"
          size="28"
          name="material-symbols:language"
        />
        <v-menu content-class="v-menu-mixin" transition="slide-y-transition">
          <template v-slot:activator="{ props }">
            <Icon
              class="cursor-pointer"
              v-bind="props"
              size="28"
              name="material-symbols:account-circle-full"
            />
          </template>
          <v-list class="p-0">
            <v-list-item :prepend-icon="item.icon" v-for="(item, i) in userItems" :key="i" @click="item.click">
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-menu>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import type { RESPONSE_ERROR, RESPONSE_NOT_DATA } from '@types'
export default defineComponent({
  setup() {
    const store = useStore()
    return { store }
  },
  data() {
    return {
      userItems: [
        {
          title: "Thông tin cá nhân",
          icon: 'mdi-card-account-details-outline',
          click: () => {}
        },
        {
          title: "Đăng xuất",
          icon: 'mdi-logout-variant',
          click: this.handleLogout
        },
      ],
    };
  },
  methods: {
    handleToggleSidebar(): void {
      this.$emit("toggleSidebar");
    },
    async handleLogout() {
      try {
        const response = await this.$axios.post<undefined, RESPONSE_NOT_DATA>('logout')
        const data = response.data as RESPONSE_NOT_DATA
        this.$notify({ title: this.$t('success', [this.$t('logout')]), text: data.message, type: 'success' })
      } catch(e) {
        const error = e as RESPONSE_ERROR
        this.$notify({ title: this.$t('failed', [this.$t('logout')]), text: error.message, type: 'error' })
      } finally {
        logout()
        this.store.dispatch('user/logout')
        this.$ability.update([{action: 'read', subject: 'guest'}])
        if (this.$route.path != '/')
          this.$router.replace('/')
      }
    }
  },
  computed: {
  },
});
</script>

<style scoped>
.admin-header {
  padding: 0 24px;
  background-color: #fff;
  -webkit-box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.15);
  box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.15);
  min-height: 70px;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.right-header {
  color: #98a6ad;
  display: flex;
  gap: 1rem;
  align-items: center;
}
</style>

<style lang="scss">
.v-menu-mixin {
  transform: translateY(21px) !important;
  .v-list-item:hover {
    background: #686868 !important;
    color: white;
  }
}
</style>
