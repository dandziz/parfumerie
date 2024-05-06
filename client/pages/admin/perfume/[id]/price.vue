<template>
  <v-card title="Quản lý giá nước hoa" class="position-relative">
    <VOverlay class="component-overlay" persistent contained v-model="loading">
      <VProgressCircular
        indeterminate
        color="primary"
        :width="2"
        :size="50"
        class="text-success"
      />
    </VOverlay>
    <v-dialog max-width="450" class="custom-modal" v-model:model-value="dialog">
      <dialog-close-button />
      <v-card title="Xóa giá nước hoa?">
        <v-card-text
          >Bạn có chắc chắn muốn xóa giá nước hoa này không ?</v-card-text
        >
        <v-card-actions class="gap-2">
          <v-spacer />
          <AppButton bgNone @click="dialog = false">Hủy</AppButton>
          <AppButton
            bg="bg-danger"
            @click="handleDeletePrice"
            :loading="deleteLoading"
            >Đồng ý</AppButton
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-card-item title="Đang có">
      <!-- <transition-group name="list"> -->
      <v-row class="mt-2" v-for="(item, ind) in currentPrices" :key="ind">
        <v-col cols="4"
          ><app-combobox-field
            label="Dung tích"
            v-model="item.capacity"
            :items="capacityLabel"
            transfer="uppercase"
            :rules="[
              requiredValidator,
              uniqueValidator(item.capacity, capacityCheck, ind),
            ]"
            :readonly="currentUpdate != item.id"
          ></app-combobox-field
        ></v-col>
        <v-col cols="3"
          ><app-input-field
            label="Giá nhập"
            type="number"
            v-model="item.import_price"
            :rules="[requiredValidator, integerValidator]"
            min="0"
            :readonly="currentUpdate != item.id"
          ></app-input-field
        ></v-col>
        <v-col cols="3"
          ><app-input-field
            label="Giá"
            type="number"
            v-model="item.price"
            :rules="[requiredValidator, integerValidator]"
            min="0"
            :readonly="currentUpdate != item.id"
          ></app-input-field
        ></v-col>
        <v-col cols="2" class="mx-auto my-auto"
          ><v-switch
            color="primary"
            v-model:model-value="item.quantity"
            label="Còn hàng"
            class="hidden-details"
            :disabled="currentUpdate != item.id"
          ></v-switch
        ></v-col>
        <v-col cols="12" class="d-flex mx-auto my-auto pt-0">
          <AppButton
            v-if="currentUpdate != item.id"
            bg-none
            @click="currentUpdate = item.id as number"
            ><Icon name="mynaui:edit-one" size="28" class="text-primary"
          /></AppButton>
          <AppButton v-else bg-none @click="handleUpdatePrice(item)"
            ><Icon
              name="material-symbols:download-done-rounded"
              size="28"
              class="text-primary"
          /></AppButton>
          <AppButton
            v-if="currentUpdate != item.id"
            bg-none
            @click="handleAskDelete(item, ind)"
            ><Icon
              name="fluent:delete-48-regular"
              size="28"
              class="text-danger"
          /></AppButton>
          <AppButton v-else bg-none @click="handleUndo(ind)"
            ><Icon name="jam:undo" size="28" class="text-danger"
          /></AppButton>
        </v-col>
      </v-row>
      <!-- </transition-group> -->
    </v-card-item>
    <v-divider thickness="3"></v-divider>
    <v-card-item title="Thêm mới">
      <v-form @submit.prevent="onSubmit" v-model="formValidation" ref="form">
        <v-row class="mt-2">
          <v-col cols="4"
            ><app-combobox-field
              label="Dung tích"
              v-model="capacity.capacity"
              :items="capacityLabel"
              transfer="uppercase"
              :rules="[
                requiredValidator,
                uniqueValidator(capacity.capacity, capacityCheck, 10000),
              ]"
            ></app-combobox-field
          ></v-col>
          <v-col cols="3"
            ><app-input-field
              label="Giá nhập"
              type="number"
              v-model="capacity.import_price"
              :rules="[requiredValidator, integerValidator]"
              min="0"
            ></app-input-field
          ></v-col>
          <v-col cols="3"
            ><app-input-field
              label="Giá"
              type="number"
              v-model="capacity.price"
              :rules="[requiredValidator, integerValidator]"
              min="0"
            ></app-input-field
          ></v-col>
          <v-col cols="2" class="mx-auto my-auto"
            ><v-switch
              color="primary"
              v-model:model-value="capacity.quantity"
              label="Còn hàng"
              class="hidden-details"
            ></v-switch
          ></v-col>
        </v-row>
        <v-card-actions class="p-0 gap-2">
          <v-spacer></v-spacer>
          <app-button bg="bg-danger" @click="clear">Reset</app-button>
          <app-button type="submit">Thêm mới</app-button>
        </v-card-actions>
      </v-form>
    </v-card-item>
  </v-card>
</template>

<script lang="ts">
import {
  requiredValidator,
  integerValidator,
  uniqueValidator,
} from "@validator";
import type { RESPONSE_DATA_SUCCESS, RESPONSE_ERROR } from "~/types";
import type { Price } from "@/models";
export default {
  setup() {
    useHead({
      title: "Giá nước hoa",
    });
    definePageMeta({
      layout: 'admin',
      middleware: ["admin"]
    })
    const route = useRoute();
    const currentPrices = ref<Price[]>([]);
    const initialPrices = ref<Price[]>([]);
    const perfumeId = route.params.id as string;
    return {
      perfumeId,
      requiredValidator,
      integerValidator,
      uniqueValidator,
      currentPrices,
      initialPrices,
    };
  },
  mounted() {
    this.fetch();
  },
  data() {
    return {
      capacityLabel: [
        "CHIẾT 10ML",
        "CHIẾT 20ML",
        "CHIẾT 30ML",
        "FULLBOX 100ML",
      ],
      capacity: {
        capacity: "",
        import_price: "",
        price: "",
        quantity: false,
      },
      errors: {
        capacity: "",
        import_price: "",
        price: "",
        quantity: "",
      },
      loading: false,
      currentUpdate: -1,
      dialog: false,
      price: {},
      index: -1,
      deleteLoading: false,
      formValidation: false,
    };
  },
  methods: {
    async fetch() {
      try {
        const response = await this.$axios.get<RESPONSE_DATA_SUCCESS<Price[]>>(
          `admin/perfumes/${this.perfumeId}/prices`
        );
        this.currentPrices = JSON.parse(JSON.stringify(response.data.data));
        this.initialPrices = JSON.parse(JSON.stringify(response.data.data));
      } catch (e) {}
    },
    handleUndo(index: number) {
      for (let i = 0; i < this.initialPrices.length; i++) {
        if (this.initialPrices[i].id == this.currentPrices[index].id) {
          this.currentPrices[index] = JSON.parse(
            JSON.stringify(this.initialPrices[i])
          );
          break;
        }
      }
      this.currentUpdate = -1;
    },
    async handleUpdatePrice(item: Price) {
      const data = JSON.parse(JSON.stringify(item)) as Price;
      const id = data.id;
      const arr = [
        "id",
        "perfume_id",
        "updated_at",
        "created_at",
        "deleted_at",
      ];
      for (let i = 0; i < arr.length; i++) {
        delete data[arr[i] as keyof Price];
      }
      try {
        this.loading = true;
        const response = await this.$axios.patch<
          undefined,
          Pick<Price, "capacity" | "import_price" | "price" | "quantity">
        >(`admin/perfumes/${this.perfumeId}/prices/${id}`, data);
        for (let i = 0; i < this.initialPrices.length; i++) {
          if (this.initialPrices[i].id == item.id) {
            this.initialPrices[i] = JSON.parse(JSON.stringify(item));
            break;
          }
        }
        this.currentUpdate = -1;
        successfulNotification(
          "Thành công!",
          "Cập nhật thông tin giá nước hoa thành công!"
        );
      } catch (e) {
        const error = e as RESPONSE_ERROR;
        failureNotification("Lỗi!", error.message);
      } finally {
        this.loading = false;
      }
    },
    handleAskDelete(item: Price, ind: number) {
      this.price = item;
      this.index = ind;
      this.dialog = true;
    },
    async handleDeletePrice() {
      if (Object.keys(this.price).length == 0) return;
      const item = this.price as Price;
      try {
        this.deleteLoading = true;
        const response = await this.$axios.delete(
          `admin/perfumes/${this.perfumeId}/prices/${item.id}`
        );
        for (let i = 0; i < this.initialPrices.length; i++) {
          if (this.initialPrices[i].id == item.id) {
            this.initialPrices.splice(i, 1);
            break;
          }
        }
        this.currentPrices.splice(this.index, 1);
        this.currentUpdate = -1;
        this.index = -1;
        this.price = {};
        this.dialog = false;
        successfulNotification("Thành công!", "Xóa giá nước hoa thành công!");
      } catch (e) {
        const error = e as RESPONSE_ERROR;
        failureNotification("Lỗi!", error.message);
      } finally {
        this.deleteLoading = false;
      }
      this.currentUpdate = -1;
    },
    async onSubmit() {
      if (this.formValidation) {
        try {
          this.loading = true;
          const response = await this.$axios.post<
            Price,
            Pick<Price, "capacity" | "import_price" | "price" | "quantity">
          >(`admin/perfumes/${this.perfumeId}/prices`, this.capacity);
          this.currentPrices.push(response.data.data);
          this.initialPrices.push(response.data.data);
          this.fetch();
          this.clear();
          successfulNotification(
            "Thêm thành công!",
            "Thêm giá nước hoa thành công."
          );
        } catch (e) {
          failureNotification("Lỗi!", "Thêm giá nước hoa thất bại.");
          const error = e as RESPONSE_ERROR;
          this.errors = error.error as typeof this.errors;
        } finally {
          this.loading = false;
        }
      }
    },
    clear() {
      (this.$refs?.form as HTMLFormElement)?.reset();
      this.capacity.quantity = false;
    },
    sortCapacities() {},
  },
  computed: {
    capacityCheck() {
      return this.initialPrices.map((value) => value.capacity);
    },
  },
};
</script>

<style lang="scss" scoped></style>
