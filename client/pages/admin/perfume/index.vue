<template>
  <v-card title="Danh sách nước hoa">
    <div class="container">
      <v-row>
        <v-col cols="12">
          <app-loading :model-value="loading"></app-loading>
          <v-data-table-server
            :items-per-page="options.itemsPerPage"
            :headers="headers"
            :items-length="options.totalItems"
            :items="options.serverItems"
            :loading="loading"
            item-value="name"
            :no-wrap="true"
            @update:sortBy="onSortTable"
          >
            <template v-slot:bottom>
              <v-row wrap>
                <v-col cols="12" md="5">
                  <div class="table-selected mt-1">
                    <v-row wrap>
                      <v-col cols="7"
                        ><v-select
                          dense
                          outlined
                          hide-details
                          :model-value="options.itemsPerPage"
                          label="Số nước hoa mỗi trang"
                          item-title="text"
                          item-value="value"
                          :items="perPageChoices"
                          density="compact"
                          variant="outlined"
                          color="primary"
                          @update:modelValue="onUpdatePerPage"
                        >
                        </v-select
                      ></v-col>
                      <v-col cols="5">
                        <v-text-field
                          label="Trang"
                          type="number"
                          min="1"
                          :max="options.totalPages"
                          density="compact"
                          variant="outlined"
                          v-model="options.currentPage"
                          color="primary"
                          @update:modelValue="onUpdatePage"
                        >
                        </v-text-field>
                      </v-col>
                    </v-row>
                  </div>
                </v-col>
                <v-col cols="12" md="7" class="ps-0">
                  <app-pagination
                    v-model="options.currentPage"
                    class="my-4"
                    :length="options.totalPages"
                    @update:modelValue="onUpdatePage"
                  ></app-pagination>
                </v-col>
              </v-row>
            </template>
            <template v-slot:loading>
              <v-skeleton-loader
                :type="`table-row@${options.itemsPerPage}`"
              ></v-skeleton-loader>
            </template>
            <template #item.supplier_name="{ item }">
              <span class="position-relative"
                >{{
                  item.supplier_name.length > 15
                    ? item.supplier_name.substring(0, 12) + "..."
                    : item.supplier_name
                }}<v-tooltip activator="parent" location="top">{{
                  item.supplier_name
                }}</v-tooltip></span
              >
            </template>
            <template #item.actions="{ item }">
              <div class="d-flex gap-1">
                <Button bg="bg-primary" class="p-1">
                  <Icon name="mingcute:edit-line" size="20"></Icon
                ></Button>
                <Button bg="bg-danger" class="p-1">
                  <Icon name="mingcute:delete-line" size="20"></Icon
                ></Button>
              </div>
            </template>
          </v-data-table-server>
        </v-col>
      </v-row>
    </div>
  </v-card>
</template>

<script lang="ts">
import type { GET_LIST_RESPONSE } from "@types";
import type { Perfume } from "@/models";

export default {
  setup() {
    useHead({
      title: "Đơn hàng của bạn",
      meta: [
        {
          name: "",
          content: "",
        },
      ],
    });
    return {};
  },
  data() {
    return {
      loading: false,
      headers: [
        { title: "ID", sortable: true, key: "id" },
        { title: "Mã", sortable: false, key: "code" },
        { title: "Tên", sortable: false, key: "name" },
        {
          title: "Giới tính",
          sortable: false,
          key: "gender",
        },
        {
          title: "Ngày bán",
          sortable: true,
          key: "start_date",
        },
        {
          title: "Status",
          sortable: false,
          key: "status",
        },
        {
          title: "Thương hiệu",
          sortable: false,
          key: "brand_name",
        },
        {
          title: "Nhà cung cấp",
          sortable: false,
          key: "supplier_name",
        },
        {
          title: "Actions",
          sortable: false,
          key: "actions",
        },
      ],
      options: {
        itemsPerPage: 10,
        totalItems: -1,
        totalPages: -1,
        serverItems: [] as Perfume[],
        currentPage: 1,
        sort: {
          sortBy: "",
          order: "",
        },
      },
      perPageChoices: [
        { text: "5", value: 5 },
        { text: "10", value: 10 },
        { text: "20", value: 20 },
        { text: "50", value: 50 },
      ],
    };
  },
  mounted() {
    this.loadItems();
  },
  methods: {
    async loadItems(): Promise<void> {
      try {
        this.loading = true;
        let config = {
          itemsPerPage: this.options.itemsPerPage,
          currentPage: this.options.currentPage,
        } as {
          itemsPerPage: number;
          currentPage: number;
          sortBy?: string;
          order?: string;
        };
        if (this.options.sort.order && this.options.sort.sortBy) {
          config.sortBy = this.options.sort.sortBy;
          config.order = this.options.sort.order;
        }
        const response = await this.$axios.get<GET_LIST_RESPONSE<Perfume>>(
          "admin/perfumes",
          config
        );
        const data = response.data;
        this.options.serverItems = data.data;
        this.options.totalItems = data.pagination.total;
        this.options.itemsPerPage = data.pagination.per_page;
        this.options.totalPages = data.pagination.last_page;
      } catch (e) {
        failureNotification("Lấy danh sách nước hoa thất bại!");
      } finally {
        this.loading = false;
      }
    },
    onUpdatePerPage(value: number): void {
      this.options.itemsPerPage = value;
      this.loadItems();
    },
    onUpdatePage(value: string): void {
      const currentValue = parseInt(value);
      if (
        this.options.totalPages > 1 &&
        currentValue <= this.options.totalPages
      ) {
        this.options.currentPage = currentValue;
        this.loadItems();
      }
    },
    onSortTable(value: Array<{ key: string; order: string }>): void {
      if (value && value.length > 0) {
        const val = value[0];
        this.options.sort.sortBy = val.key;
        this.options.sort.order = val.order;
        this.loadItems();
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
