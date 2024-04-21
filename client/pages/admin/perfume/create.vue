<template>
  <v-card title="Thêm nước hoa">
    <VOverlay
      class="component-overlay"
      persistent
      contained
      :model-value="loading"
    >
      <VProgressCircular
        indeterminate
        color="primary"
        :width="2"
        :size="50"
        class="text-success"
      />
    </VOverlay>
    <v-form
      @submit.prevent="onSubmit"
      class="mt-2"
      v-model="formValidation"
      ref="form"
    >
      <v-divider thickness="3"></v-divider>
      <v-card-item title="Thông tin cơ bản">
        <v-row class="mt-2">
          <v-col cols="12" sm="6">
            <app-input-field
              label="Mã nước hoa"
              v-model="forms.code"
              :rules="[requiredValidator]"
              v-model:errorCustom="errors.code"
              readonly
              append-inner-icon="mdi mdi-reload"
              @click:appendInner="generateCode"
            >
            </app-input-field>
          </v-col>
          <v-col cols="12" sm="6">
            <app-input-field
              label="Tên nước hoa"
              v-model="forms.name"
              :rules="[requiredValidator]"
              v-model:errorCustom="errors.name"
              @onInput="handleInputName"
            ></app-input-field>
          </v-col>
          <v-col cols="12" sm="6">
            <app-input-field
              label="Slug"
              v-model="forms.slug"
              :rules="[requiredValidator]"
              v-model:errorCustom="errors.slug"
            ></app-input-field>
          </v-col>
          <v-col cols="12" sm="6">
            <div class="form-label fw-bold">
              Giới tính<span class="text-danger">*</span>
            </div>
            <v-radio-group
              inline
              v-model="forms.gender"
              :rules="[requiredValidator]"
              :error-messages="errors.gender"
              ripple
              @update:model-value="errors.gender = ''"
            >
              <v-radio
                v-for="(item, ind) in genders"
                :key="ind"
                color="primary"
                :label="item.label"
                :value="item.value"
              ></v-radio>
            </v-radio-group>
          </v-col>
          <v-col cols="12" sm="6">
            <app-input-field
              label="Xuất xứ"
              v-model="forms.origin"
              :rules="[requiredValidator]"
              v-model:errorCustom="errors.origin"
            ></app-input-field>
          </v-col>
          <v-col cols="12" sm="6">
            <app-textarea-field
              label="Mô tả"
              v-model="forms.description"
              :rules="[requiredValidator]"
              v-model:errorCustom="errors.description"
            >
            </app-textarea-field>
          </v-col>
          <v-col cols="12" sm="6">
            <app-autocomplete-field
              label="Thương hiệu"
              v-model="forms.brand_id"
              :items="brands"
              item-title="name"
              item-value="id"
              :rules="[requiredValidator]"
              v-model:errorCustom="errors.brand_id"
            ></app-autocomplete-field>
          </v-col>
          <v-col cols="12" sm="6">
            <app-autocomplete-field
              label="Nhà cung cấp"
              v-model="forms.supplier_id"
              :items="suppliers"
              item-title="name"
              item-value="id"
              :rules="[requiredValidator]"
              v-model:errorCustom="errors.supplier_id"
            ></app-autocomplete-field>
          </v-col>
        </v-row>
      </v-card-item>
      <v-divider thickness="3"></v-divider>
      <v-card-item title="Dung tích">
        <template #append>
          <img
            src="/icons/bi--sort-numeric-down.svg"
            class="cursor-pointer"
            alt=""
            @click="sortCapacities"
          />
        </template>
        <!-- <transition-group name="list"> -->
        <v-row class="mt-2" v-for="(item, ind) in capacities" :key="ind">
          <v-col cols="3"
            ><app-combobox-field
              ref="capacity"
              label="Dung tích"
              v-model="item[0]"
              :items="capacityLabel"
              transfer="uppercase"
              :rules="[
                requiredValidator,
                uniqueValidator(item[0], capacityCheck, ind),
              ]"
              @onChange="onChangeCapacity"
            ></app-combobox-field
          ></v-col>
          <v-col cols="3"
            ><app-input-field
              label="Giá nhập"
              type="number"
              v-model="item[1]"
              :rules="[requiredValidator, integerValidator]"
              min="0"
              @onInput="errors.prices = ''"
            ></app-input-field
          ></v-col>
          <v-col cols="3"
            ><app-input-field
              label="Giá"
              type="number"
              v-model="item[2]"
              :rules="[requiredValidator, integerValidator]"
              min="0"
              @onInput="errors.prices = ''"
            ></app-input-field
          ></v-col>
          <v-col cols="2" lg="2" class="mx-auto my-auto"
            ><v-switch
              color="primary"
              v-model:model-value="item[3]"
              label="Còn hàng"
              class="hidden-details"
            ></v-switch
          ></v-col>
          <v-col cols="12" lg="1" class="d-flex my-auto">
            <AppButton
              bg-none
              @click="handleRemoveCapacity(ind)"
              v-if="ind < capacities.length - 1"
              ><img src="/icons/mynaui--minus-square.svg" alt=""
            /></AppButton>
            <AppButton
              bg-none
              @click="handleAddCapacity"
              v-if="ind == capacities.length - 1"
              ><img src="/icons/mynaui--plus-square.svg" alt="" /></AppButton
          ></v-col>
        </v-row>
        <!-- </transition-group> -->
        <v-messages
          active
          :messages="errors.prices"
          class="message-danger opacity-100"
        ></v-messages>
      </v-card-item>
      <v-divider thickness="3"></v-divider>
      <v-card-item title="Ảnh">
        <drag-and-drop
          ref="uploadImages"
          v-model="files"
          :max-size="fileValidation.maxSize"
          :max-file="fileValidation.maxFile"
          v-model:error-messages="errors.images"
          class="mt-2"
          :key="keyUploadImages"
        ></drag-and-drop>
      </v-card-item>
      <v-card-actions class="gap-2 px-4">
        <v-spacer></v-spacer>
        <AppButton type="button" bg="bg-danger" @click="clear">Clear</AppButton>
        <AppButton type="submit">Thêm nước hoa</AppButton>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script lang="ts">
import { PerfumeGender } from "~/enums";

import {
  requiredValidator,
  integerValidator,
  uniqueValidator,
} from "@validator";
import type { Brand, Perfume, Supplier } from "~/models";
import type { RESPONSE_ERROR, RESPONSE_API_SUCCESS } from "~/types";
export default {
  setup() {
    const brands = reactive<Brand[]>([]);
    const suppliers = reactive<Pick<Supplier, "id" | "name">[]>([]);
    const files = reactive<Array<File>>([]);
    useHead({
      title: "Thêm nước hoa",
    });
    definePageMeta({
      middleware: ["admin"],
    });
    return {
      brands,
      suppliers,
      PerfumeGender,
      requiredValidator,
      integerValidator,
      uniqueValidator,
      files,
    };
  },
  components: {},
  data() {
    return {
      formValidation: false,
      loading: false,
      forms: {
        code: "",
        name: "",
        slug: "",
        gender: "",
        origin: "",
        description: "",
        brand_id: "",
        supplier_id: "",
      },
      errors: {
        code: "",
        name: "",
        slug: "",
        gender: "",
        origin: "",
        description: "",
        brand_id: "",
        supplier_id: "",
        images: "",
        prices: "",
      },
      genders: [
        { label: "Nam", value: 1 },
        { label: "Nữ", value: 0 },
        { label: "Unisex", value: 2 },
      ],
      capacityLabel: [
        "CHIẾT 10ML",
        "CHIẾT 20ML",
        "CHIẾT 30ML",
        "FULLBOX 100ML",
      ],
      capacities: [["", "", "", false]],
      fileValidation: {
        maxSize: 10000000,
        maxFile: 10,
      },
      keyUploadImages: String(Date.now()),
    };
  },
  mounted() {
    this.fetch();
    this.generateCode();
  },
  methods: {
    async onSubmit() {
      if (this.formValidation) {
        if (this.files && this.files.length > 0) {
          if (this.files.length > this.fileValidation.maxFile) {
            this.errors.images = "Số lượng ảnh vượt quá quy định!";
            return;
          }
          for (let i = 0; i < this.files.length; i++) {
            if (this.files[i].size > this.fileValidation.maxSize) {
              this.errors.images = `File ${
                this.files[i].name
              } vượt quá kích cỡ cho phép là ${
                this.fileValidation.maxSize / 1000000
              }MB!`;
              return;
            }
          }
        } else {
          this.errors.images = "Chưa có ảnh nào được tải lên!";
          return;
        }
        if (
          !this.capacities ||
          !this.capacities[0][0] ||
          !this.capacities[0][1] ||
          !this.capacities[0][2]
        ) {
          return;
        }
        try {
          this.loading = true;
          const data = { ...this.forms };
          let formData = new FormData();
          for (let key in data) {
            formData.append(key, (data as any)[key]);
          }
          for (var i = 0; i < this.files.length; i++) {
            let file = this.files[i];
            formData.append("images[" + i + "]", file);
          }
          formData.append("prices", JSON.stringify(this.capacities));
          const response = await this.$axios.post<Perfume, FormData>(
            "admin/perfumes",
            formData,
            undefined,
            {
              "Content-Type": "multipart/form-data",
            }
          );
          successfulNotification(
            response.data.message,
            "Thêm nước hoa thành công!"
          );
          this.generateCode();
        } catch (e) {
          const error = e as RESPONSE_ERROR;
          this.errors = error.error as typeof this.errors;
        } finally {
          this.loading = false;
        }
      }
    },
    generateCode() {
      this.forms.code = generateRandomString();
      if (this.errors.code) {
        this.errors.code = "";
      }
    },
    clear() {
      (this.$refs?.form as HTMLFormElement)?.reset();
      this.capacities = [["", "", "", false]];
      if (
        this.$refs.uploadImages &&
        (this.$refs.uploadImages as any)?.resetImages
      ) {
        (this.$refs.uploadImages as any).resetImages();
      }
      this.keyUploadImages = String(Date.now());
      this.errors = {
        code: "",
        name: "",
        slug: "",
        gender: "",
        origin: "",
        description: "",
        brand_id: "",
        supplier_id: "",
        images: "",
        prices: "",
      };
      this.generateCode();
    },
    handleInputName(value: string) {
      this.forms.slug = changeToSlug(value);
    },
    async fetch() {
      try {
        this.loading = true;
        const brands = await this.$axios.get<RESPONSE_API_SUCCESS<Brand[]>>(
          "brands"
        );
        this.brands = brands.data.data;
        const suppliers = await this.$axios.get<
          RESPONSE_API_SUCCESS<Pick<Supplier, "id" | "name">[]>
        >("admin/suppliers/all");
        this.suppliers = suppliers.data.data;
      } catch (e) {
        failureNotification("Lấy thông tin liên quan không thành công!");
      } finally {
        this.loading = false;
      }
    },
    handleAddCapacity() {
      this.capacities.push(["", "", "", false]);
    },
    handleRemoveCapacity(index: number) {
      this.capacities.splice(index, 1);
    },
    sortCapacities() {
      this.capacities.sort(
        (a: Array<string | boolean>, b: Array<string | boolean>): number => {
          const aValue = parseInt(a[2] as string);
          const bValue = parseInt(b[2] as string);
          return aValue - bValue;
        }
      );
    },
    onChangeCapacity() {
      this.errors.prices = "";
    },
  },
  computed: {
    capacityCheck() {
      return this.capacities.map((value) => value[0]) as string[];
    },
  },
};
</script>

<style lang="scss" scoped></style>
