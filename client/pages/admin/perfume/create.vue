<template>
  <v-card title="Thêm nước hoa">
    <VOverlay
      class="component-overlay"
      persistent
      contained
      :model-value="isLoading"
    >
      <VProgressCircular
        indeterminate
        color="primary"
        :width="2"
        :size="50"
        class="text-success"
      />
    </VOverlay>
    <v-form @submit.prevent="onSubmit" class="mt-2" v-model="formValidation">
      <v-row>
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
            ripple
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
            label="Thương hiệu"
            v-model="forms.supplier_id"
            :items="suppliers"
            item-title="name"
            item-value="id"
            :rules="[requiredValidator]"
            v-model:errorCustom="errors.supplier_id"
          ></app-autocomplete-field>
        </v-col>
        <v-col cols="12" class="d-flex justify-content-end">
          <Button type="submit">Thêm nước hoa</Button>
        </v-col>
      </v-row>
    </v-form>
  </v-card>
</template>

<script lang="ts">
import { PerfumeGender } from "~/enums";
import {
  confirmedValidator,
  requiredValidator,
  minValidator,
} from "@validator";
import type { Brand, Perfume, Supplier } from "~/models";
import type { RESPONSE_ERROR, RESPONSE_API_SUCCESS } from "~/types";
export default {
  setup() {
    const brands = reactive<Brand[]>([]);
    const suppliers = reactive<Pick<Supplier, "id" | "name">[]>([]);
    return {
      brands,
      suppliers,
      PerfumeGender,
      requiredValidator,
    };
  },
  data() {
    return {
      formValidation: false,
      isLoading: false,
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
      },
      genders: [
        { label: "Nam", value: 1 },
        { label: "Nữ", value: 0 },
        { label: "Unisex", value: 2 },
      ],
    };
  },
  mounted() {
    this.fetch();
    this.generateCode();
  },
  methods: {
    async onSubmit() {
      if (this.formValidation) {
        try {
          this.isLoading = true;
          const data = { ...this.forms };
          const response = await this.$axios.post<
            Perfume,
            Omit<
              Perfume,
              | "id"
              | "user_id"
              | "updated_at"
              | "created_at"
              | "product_information"
              | "start_date"
              | "rate"
              | "status"
              | "brand_name"
              | "supplier_name"
            >
          >("admin/perfumes", data);
          console.log(response);
        } catch (e) {
          const error = e as RESPONSE_ERROR;
          this.errors = error.error as typeof this.errors;
        } finally {
          this.isLoading = false;
        }
      }
    },
    generateCode() {
      this.forms.code = generateRandomString();
      if (this.errors.code) {
        this.errors.code = ''
      }
    },
    handleInputName(value: string) {
      this.forms.slug = changeToSlug(value);
    },
    async fetch() {
      try {
        this.isLoading = true;
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
        this.isLoading = false;
      }
    },
  },
};
</script>

<style lang="scss" scoped></style>
