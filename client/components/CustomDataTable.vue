<template>
  <div class="position-relative">
    <VOverlay
      class="component-overlay"
      persistent
      contained
      :model-value="loading"
    >
    </VOverlay>
    <v-data-table-server
      :items-per-page="perPage"
      :headers="headers"
      :items-length="totalItems"
      :items="serverItems"
      :loading="loading"
      item-value="name"
      :no-wrap="true"
      @update:sortBy="onSortTable"
    >
      <template v-slot:bottom="{ page, itemsPerPage, pageCount }">
        <v-row wrap>
          <v-col cols="12" md="5">
            <div class="table-selected mt-1">
              <v-row wrap>
                <v-col cols="7"
                  ><v-select
                    dense
                    outlined
                    hide-details
                    :model-value="perPage"
                    label="Số đơn hàng"
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
                    :max="pageCount"
                    density="compact"
                    variant="outlined"
                    v-model="currentPage"
                    color="primary"
                    @update:modelValue="onInputPage"
                  >
                  </v-text-field>
                </v-col>
              </v-row>
            </div>
          </v-col>
          <v-col cols="12" md="7" class="ps-0">
            <v-pagination
              @update:modelValue="onUpdatePage"
              v-model="currentPage"
              class="my-4"
              :length="pageCount"
              :total-visible="displayPaginate"
            ></v-pagination>
          </v-col>
        </v-row>
      </template>
      <template v-slot:loading>
        <v-skeleton-loader :type="`table-row@${perPage}`"></v-skeleton-loader>
      </template>
    </v-data-table-server>
  </div>
</template>

<script lang="ts">
export default {
  setup() {
    return {};
  },
  data() {
    return {
      currentPage: 1,
      perPageChoices: [
        { text: "5", value: 5 },
        { text: "10", value: 10 },
        { text: "20", value: 20 },
        { text: "50", value: 50 },
      ],
    };
  },
  methods: {
    onUpdatePage(value: number): void {
      this.$emit('onUpdatePage', value)
    },
    onUpdatePerPage(value: number): void {
      this.$emit('onUpdatePerPage', value)
    },
    onInputPage(value: string): void {
      const currentValue = parseInt(value)
      if (this.totalPages > 1 && currentValue <= this.totalPages) {
        this.currentPage = currentValue
        this.$emit('onUpdatePage', currentValue)
      }
    },
    handleInputPage(value: any) {
      const inputPageValue = value?.target?._value
      this.currentPage = inputPageValue ? parseInt(inputPageValue) : this.currentPage
      this.$emit('onUpdatePage', this.currentPage)
    },
    onSortTable(value: Array<{key: string, order: string}>) {
      this.$emit('onSortTable', value)
    }
  },
  computed: {
    displayPaginate() {
      if (this.$vuetify.display.width > 1280) return 7;
      else if (
        this.$vuetify.display.width <= 1280 &&
        this.$vuetify.display.width > 1200
      )
        return 6;
      else if (
        this.$vuetify.display.width <= 1200 &&
        this.$vuetify.display.width > 960
      )
        return 4
      else if (
        this.$vuetify.display.width <= 960 &&
        this.$vuetify.display.width > 480
      )
        return 6
      else return 3;
    },
  },
  props: {
    perPage: {
      type: Number,
      required: true,
    },
    headers: {
      type: Object,
      required: true,
    },
    totalItems: {
      type: Number,
      required: true,
    },
    loading: {
      type: Boolean,
      required: true,
    },
    serverItems: {
      type: Array,
      required: true,
    },
    totalPages: {
      type: Number,
      required: true,
    }
  },
};
</script>

<style lang="scss" scoped>
.table-selected {
  padding: 16px;
}
</style>
