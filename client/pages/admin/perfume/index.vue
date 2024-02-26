<template>
  <v-card title="Danh sách nước hoa">
    <v-dialog max-width="450" class="custom-modal" v-model:model-value="dialog">
      <dialog-close-button />
      <v-card title="Xóa nước hoa?">
        <v-card-text
          >Bạn có chắc chắn muốn xóa sản phẩm nước hoa này không ?</v-card-text
        >
        <v-card-actions class="gap-2">
          <v-spacer />
          <AppButton bgNone @click="dialog = false">Hủy</AppButton>
          <AppButton bg="bg-danger">Đồng ý</AppButton>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-row>
      <v-col cols="12">
        <v-card-actions>
          <v-switch
            v-if="$vuetify.display.width <= 1430"
            color="primary"
            v-model:model-value="hiddenColumn"
            :label="hiddenColumn ? 'Ẩn cột' : 'Hiện cột'"
            class="hidden-details"
          ></v-switch>
          <v-spacer></v-spacer>
          <AppButton
            component-type="link"
            to="/admin/perfume/create"
            bg="bg-primary"
            >Thêm nước hoa</AppButton
          >
        </v-card-actions>
      </v-col>
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
          <template #item.gender="{ item }">
            <span>{{ PerfumeGenderName[item.gender] }}</span>
          </template>
          <template #item.status="{ item }">
            <span
              :class="{
                'tag-success': item.status == PerfumerStatus.Active,
                'tag-danger': item.status == PerfumerStatus.Inactive,
              }"
              >{{ PerfumerStatusName[item.status as number] }}</span
            >
          </template>
          <template #item.supplier_name="{ item }">
            <span class="position-relative"
              >{{
                item.supplier_name && item.supplier_name.length > 15
                  ? item.supplier_name.substring(0, 12) + "..."
                  : item.supplier_name
              }}<v-tooltip
                activator="parent"
                location="top"
                v-if="item.supplier_name && item.supplier_name.length > 15"
                >{{ item.supplier_name }}</v-tooltip
              ></span
            >
          </template>
          <template #item.actions="{ item }">
            <div class="d-flex gap-1">
              <AppButton
                component-type="link"
                :to="{
                  name: 'admin-perfume-id',
                  params: {
                    id: item.id,
                  },
                }"
                bg="bg-primary"
                class="p-1"
              >
                <img
                  src="/icons/mingcute--edit-line.svg"
                  class="img-icon"
                  alt=""
                />
              </AppButton>
              <AppButton
                component-type="link"
                :to="{
                  name: 'admin-perfume-id-image',
                  params: {
                    id: item.id,
                  },
                }"
                bg="bg-success"
                class="p-1"
              >
                <img
                  src="/icons/material-symbols-light--image-outline.svg"
                  class="img-icon"
                  alt=""
                />
              </AppButton>
              <AppButton
                component-type="link"
                :to="{
                  name: 'admin-perfume-id-price',
                  params: {
                    id: item.id,
                  },
                }"
                bg="bg-secondary"
                class="p-1"
              >
                <img
                  src="/icons/solar--tag-price-linear.svg"
                  class="img-icon"
                  alt=""
                />
              </AppButton>
              <AppButton bg="bg-danger" class="p-1" @click="dialog = true">
                <img
                  src="/icons/mingcute--delete-line.svg"
                  class="img-icon"
                  alt=""
                />
              </AppButton>
            </div>
          </template>
        </v-data-table-server>
      </v-col>
    </v-row>
  </v-card>
</template>

<script lang="ts">
import type { GET_LIST_RESPONSE } from "@types";
import type { Perfume } from "@/models";
import {
  PerfumerStatus,
  PerfumeGenderName,
  PerfumeGender,
  PerfumerStatusName,
} from "~/enums";

export default {
  setup() {
    useHead({
      title: "Danh sách nước hoa",
    });
    definePageMeta({
      middleware: ["admin"]
    })
    return {
      PerfumerStatus,
      PerfumeGenderName,
      PerfumerStatusName,
    };
  },
  data() {
    return {
      loading: false,
      dialog: false,
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
      hiddenColumn: false,
    };
  },
  computed: {
    headers() {
      const hide = this.$vuetify.display.width <= 1430;
      const partOne = [
        {
          title: "Giới tính",
          sortable: false,
          key: "gender",
        },
        {
          title: "Ngày bán",
          sortable: true,
          key: "created_at",
        },
      ];
      const partTwo = [
        {
          title: "Status",
          sortable: false,
          key: "status",
        },
      ];
      const partThird = [
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
      ];
      const actions = [
        {
          title: "Actions",
          sortable: false,
          key: "actions",
          minWidth: "190px",
        },
      ];
      const headers = [
        { title: "ID", sortable: true, key: "id" },
        { title: "Mã", sortable: false, key: "code" },
        { title: "Tên", sortable: false, key: "name" },
      ];
      if (this.hiddenColumn || !hide) {
        headers.push(...partOne)
      }
      headers.push(...partTwo)
      if (this.hiddenColumn || !hide) {
        headers.push(...partThird)
      }
      headers.push(...actions)
      return headers;
    },
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
