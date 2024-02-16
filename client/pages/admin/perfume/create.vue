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
        {{ forms }}
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
          <v-radio-group inline v-model="forms.gender" :rules="[requiredValidator]" ripple>
            <v-radio label="Nam" value="0" color="primary"></v-radio>
            <v-radio label="Nữ" value="1" color="primary"></v-radio>
            <v-radio label="Unisex" value="2" color="primary"></v-radio>
          </v-radio-group>
        </v-col>
        <v-col cols="12" sm="6">
          <app-input-field
            label="Xuất xứ"
            v-model="forms.origin"
            :rules="[requiredValidator]"
          ></app-input-field>
        </v-col>
        <v-col cols="12" sm="6">
          <app-textarea-field label="Mô tả" v-model="forms.description" :rules="[requiredValidator]">
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
          ></app-autocomplete-field>
        </v-col>
        <v-col cols="12">
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
import type { RESPONSE_API_SUCCESS } from "~/types";
export default {
  setup() {
    const brands = reactive<Brand[]>([])
    const suppliers = reactive<Pick<Supplier, "id" | "name">[]>([])
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
    };
  },
  mounted() {
    this.fetch();
    this.generateCode();
  },
  methods: {
    onSubmit() {
      if (this.formValidation) {
        const data = {...this.forms}
      }
    },
    generateCode() {
      this.forms.code = generateRandomString();
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
