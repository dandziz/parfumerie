<template>
  <div class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="container">
      <div class="row perfume-info border mb-3">
        <div class="col-xs-12 col-sm-6 col-lg-5 col-md-6 p-0">
          <Thumbnail />
        </div>
        <div class="col-xs-12 col-sm-6 col-lg-7 col-md-6 details-pro">
          <h1 class="title-head"></h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
export default {
  setup() {
    
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/", name: "Nước hoa ...", active: true },
        { to: "/", name: "Nước hoa ...", active: true },
      ],
    };
  },
  mounted() {},
  computed: {},
  methods: {},
};
</script>

<style lang="scss" scoped>
.perfume-info {
  padding: 10px;
}
</style>
