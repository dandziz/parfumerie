<template>
  <v-card title="Cập nhật thông tin nước hoa">
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
      <v-card-item title="Thông tin chung">
        <v-row class="mt-2">
          <v-col cols="12"
            ><v-switch
              color="primary"
              v-model="forms.status"
              :label="!forms.status ? 'Ngưng bán' : 'Đang bán'"
              class="p-1"
            ></v-switch
          ></v-col>
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
      <v-card-item title="Tổng quan sản phẩm">
        <v-row class="mt-2">
          <v-col cols="12">
            <client-only placeholder="loading...">
              <CkeditorNuxt v-model="forms.product_information" @update:model-value="errors.product_information = ''" />
            </client-only>
            <v-messages
              active
              :messages="errors.product_information"
              class="message-danger opacity-100 pt-2 pb-1 ps-4"
            ></v-messages>
          </v-col>
        </v-row>
      </v-card-item>
      <v-card-actions class="gap-2 px-4">
        <v-spacer></v-spacer>
        <AppButton type="button" bg="bg-danger" @click="undo"
          >Hoàn Tác</AppButton
        >
        <AppButton type="submit">Cập Nhật</AppButton>
      </v-card-actions>
    </v-form>
  </v-card>
</template>

<script lang="ts">
import { requiredValidator, integerValidator } from "@validator";
import type { Brand, Perfume, Supplier, PerfumeForm } from "~/models";
import type { RESPONSE_ERROR, RESPONSE_API_SUCCESS } from "~/types";
import CkeditorNuxt from "@/views/admin/perfume/CkeditorNuxt.vue";
import { defineComponent } from "vue";
export default defineComponent({
  setup() {
    definePageMeta({
      middleware: ["admin"],
    });
    useHead({
      title: "Cập nhật |",
    });
    const route = useRoute();
    const perfumeId = route.params.id as string;
    const brands = reactive<Brand[]>([]);
    const suppliers = reactive<Pick<Supplier, "id" | "name">[]>([]);
    const initial = reactive<PerfumeForm>({
      name: "",
      code: "",
      slug: "",
      gender: 0,
      origin: "",
      description: "",
      brand_id: "",
      supplier_id: "",
      status: false,
      product_information: "",
    });
    const forms = reactive<PerfumeForm>({
      name: "",
      code: "",
      slug: "",
      gender: 0,
      origin: "",
      description: "",
      status: false,
      brand_id: "",
      supplier_id: "",
      product_information: "",
    });
    return {
      brands,
      suppliers,
      requiredValidator,
      integerValidator,
      perfumeId,
      initial,
      forms,
    };
  },
  components: {
    CkeditorNuxt,
  },
  mounted() {
    this.fetch();
    this.generateCode();
  },
  data() {
    return {
      formValidation: false,
      loading: false,
      errors: {
        code: "",
        name: "",
        slug: "",
        gender: "",
        origin: "",
        description: "",
        brand_id: "",
        supplier_id: "",
        status: "",
        product_information: "",
      },
      genders: [
        { label: "Nam", value: 1 },
        { label: "Nữ", value: 0 },
        { label: "Unisex", value: 2 },
      ],
    };
  },
  methods: {
    async onSubmit() {
      if (this.formValidation) {
        if (!this.forms.product_information) {
          this.errors.product_information = "Trường này là bắt buộc";
          return;
        }
        try {
          this.loading = true;
          const response = await this.$axios.patch<null, PerfumeForm>(
            `admin/perfumes/${this.perfumeId}`,
            this.forms
          );
          successfulNotification(
            "Thành công",
            "Cập nhật thông tin nước hoa thành công!"
          );
          this.initial = JSON.parse(JSON.stringify(this.forms));
        } catch (e) {
          const error = e as RESPONSE_ERROR;
          this.errors = error.error as typeof this.errors;
          failureNotification(
            "Lỗi",
            "Cập nhật thông tin nước hoa không thành công!"
          );
        } finally {
          this.loading = false;
        }
      }
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
        const perfume = await this.$axios.get<RESPONSE_API_SUCCESS<Perfume>>(
          `admin/perfumes/${this.perfumeId}`
        );
        const data = perfume.data.data;
        const arr = [
          "id",
          "brand_name",
          "supplier_name",
          "user_id",
          "updated_at",
          "created_at",
          "start_date",
          "rate",
        ];
        for (let i = 0; i < arr.length; i++) {
          delete data[arr[i] as keyof Perfume];
        }
        data.status = data.status == 0 ? false : true;
        this.forms = reactive(JSON.parse(JSON.stringify(data)));
        this.initial = reactive(JSON.parse(JSON.stringify(data)));
        this.forms.product_information = this.forms.product_information ?? "";
        this.suppliers = suppliers.data.data;
        document.title += " " + data.name;
      } catch (e) {
        failureNotification("Lấy thông tin liên quan không thành công!");
      } finally {
        this.loading = false;
      }
    },
    handleInputName(value: string) {
      this.forms.slug = changeToSlug(value);
    },
    generateCode() {
      this.forms.code = generateRandomString();
      if (this.errors.code) {
        this.errors.code = "";
      }
    },
    undo() {
      this.forms.code = this.initial.code;
      this.forms.name = this.initial.name;
      this.forms.slug = this.initial.slug;
      this.forms.gender = this.initial.gender;
      this.forms.origin = this.initial.origin;
      this.forms.description = this.initial.description;
      this.forms.brand_id = this.initial.brand_id;
      this.forms.supplier_id = this.initial.supplier_id;
      this.forms.status = this.initial.status;
      this.forms.product_information = this.initial.product_information;
      this.errors = {
        code: "",
        name: "",
        slug: "",
        gender: "",
        origin: "",
        description: "",
        brand_id: "",
        supplier_id: "",
        status: "",
        product_information: "",
      };
    },
  },
});
</script>

<style lang="scss" scoped></style>
