<template>
  <div class="position-relative">
    <app-loading :model-value="loading"></app-loading>
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
                    :label="labelItemsPerPage"
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
            <app-pagination
              v-model="currentPage"
              class="my-4"
              :length="pageCount"
              @update:modelValue="onUpdatePage"
            ></app-pagination>
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
    },
    labelItemsPerPage: {
      type: String,
      default: ''
    }
  },
};
</script>

<style lang="scss">

</style>
