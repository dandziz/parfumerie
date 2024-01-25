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
          <v-data-table-server
            v-model:items-per-page="itemsPerPage"
            :headers="headers"
            :items-length="totalItems"
            :items="serverItems"
            :loading="loading"
            item-value="name"
            @update:options="loadItems"
          ></v-data-table-server>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  setup() {
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
        { title: 'Đơn hàng', align: 'center', sortable: false, key: 'id' },
        { title: 'Ngày', align: 'center', sortable: true, key: 'order_date' },
        { title: 'Địa chỉ', align: 'center', sortable: false, key: 'address' },
        { title: 'Giá trị đơn hàng', align: 'center', sortable: false, key: 'price' },
        { title: 'TT thanh toán', align: 'center', sortable: false, key: 'payment_info' },
        { title: 'TT vận chuyển', align: 'center', sortable: false, key: 'delivery_info' },
      ],
      itemsPerPage: 5,
      totalItems: 50,
      loading: false,
      serverItems: []
    };
  },
  methods: {
    loadItems() {

    }
  }
};
</script>

<style lang="scss" scoped></style>
