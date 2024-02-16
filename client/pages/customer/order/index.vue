<template>
  <div class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="container">
      <div class="row customer-wrapper">
        <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
          <CustomerSidebar />
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac">
          <h5 class="text-uppercase fw-normal account-info">
            Đơn hàng của bạn
          </h5>
          <CustomDataTable
            :per-page="options.itemsPerPage"
            :headers="headers"
            :total-items="options.totalItems"
            :server-items="options.serverItems"
            :loading="options.loading"
            :current-page="options.currentPage"
            :total-pages="options.totalPages"
            item-value="name"
            label-items-per-page="Số đơn hàng mỗi trang"
            @loadItems="loadItems"
            @onUpdatePerPage="onUpdatePerPage"
            @onUpdatePage="onUpdatePage"
            @onSortTable="onSortTable"
          >
          </CustomDataTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import type { GET_LIST_RESPONSE } from "@types";
import type { Order } from "@/models";

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
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/customer", name: "Trang khách hàng", active: false },
        { to: "/customer/order", name: "Trang đơn hàng", active: true },
      ],
      headers: [
        { title: "Đơn hàng", align: "center", sortable: false, key: "code" },
        { title: "Ngày", align: "center", sortable: true, key: "order_date" },
        { title: "Địa chỉ", align: "center", sortable: false, key: "address" },
        {
          title: "Giá trị đơn hàng",
          align: "center",
          sortable: false,
          key: "total",
        },
        {
          title: "TT thanh toán",
          align: "center",
          sortable: false,
          key: "payment_status_description",
        },
        {
          title: "TT vận chuyển",
          align: "center",
          sortable: false,
          key: "delivery_status_description",
        },
      ],
      options: {
        itemsPerPage: 10,
        totalItems: -1,
        totalPages: -1,
        loading: false,
        serverItems: [] as Order[],
        currentPage: 1,
        sort: {
          sortBy: '',
          order: '',
        }
      }
    };
  },
  mounted () {
    this.loadItems()
  },
  methods: {
    async loadItems(): Promise<void> {
      try {
        this.options.loading = true
        let config = {
          itemsPerPage: this.options.itemsPerPage,
          currentPage: this.options.currentPage
        } as { itemsPerPage: number; currentPage: number; sortBy?: string; order?: string };
        if (this.options.sort.order && this.options.sort.sortBy) {
          config.sortBy = this.options.sort.sortBy
          config.order = this.options.sort.order
        }
        const response = await this.$axios.get<GET_LIST_RESPONSE<Order>>(
          "user/orders", config
        );
        const data = response.data
        this.options.serverItems = data.data
        this.options.totalItems = data.pagination.total
        this.options.itemsPerPage = data.pagination.per_page
        this.options.totalPages = data.pagination.last_page
      } catch (e) {}
      finally {
        this.options.loading = false
      }
    },
    onUpdatePerPage(value: number): void {
      this.options.itemsPerPage = value
      this.loadItems()
    },
    onUpdatePage(value: number): void {
      this.options.currentPage = value
      this.loadItems()
    },
    onSortTable(value: Array<{key: string, order: string}>): void {
      if (value && value.length > 0) {
        const val = value[0]
        this.options.sort.sortBy = val.key
        this.options.sort.order = val.order
        this.loadItems()
      }
    }
  },
};
</script>

<style lang="scss" scoped></style>
