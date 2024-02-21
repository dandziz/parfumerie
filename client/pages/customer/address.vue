<template>
  <div class="bg-white">
    <Breadcrumb :breadcrumbs="breadcrumbs" />
    <div class="container">
      <div class="row customer-wrapper">
        <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
          <CustomerSidebar />
        </div>
        <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac">
          <h5 class="text-uppercase fw-normal account-info">Địa chỉ của bạn</h5>
          <AppButton
            @click="
              dialog = true;
              methodStatus = true;
              resetForm();
            "
            class="text-uppercase rounded-sm"
            >Thêm địa chỉ</AppButton
          >
          <Modal
            :title="methodStatus ? 'Thêm địa chỉ mới' : 'Chỉnh sửa địa chỉ'"
            v-model="dialog"
            size="800"
          >
            <template v-slot:body>
              <Form
                @submit="onSubmit"
                class="mt-2"
                :initialValues="methodStatus ? forms : updateForms"
              >
                <v-row class="form-wrapper">
                  <v-col sm="6" cols="12">
                    <app-text-field
                      label="Họ tên"
                      icon="mdi:user-outline"
                      v-model="modelName"
                      name="name"
                      listOfRules="required"
                    ></app-text-field>
                  </v-col>
                  <v-col sm="6" cols="12">
                    <app-text-field
                      label="Số điện thoại"
                      icon="prime:phone"
                      v-model="modelPhoneNumber"
                      name="phone_number"
                      listOfRules="required|phoneNumber"
                    ></app-text-field>
                  </v-col>
                  <v-col sm="6" cols="12">
                    <app-text-field
                      label="Công ty"
                      icon="mdi:company"
                      v-model="modelCompany"
                      name="company"
                      listOfRules="required"
                    ></app-text-field>
                  </v-col>
                  <v-col sm="6" cols="12">
                    <app-text-field
                      label="Địa chỉ"
                      icon="mdi:address-marker-outline"
                      v-model="modelAddress"
                      name="address"
                      listOfRules="required"
                    ></app-text-field>
                  </v-col>
                  <v-col sm="4" cols="12">
                    <app-select-field
                      label="Tỉnh thành"
                      :items="provinces"
                      v-model="modelProvince"
                      listOfRules="required"
                      name="province"
                      @onChange="onChangeProvince"
                    >
                    </app-select-field>
                  </v-col>
                  <v-col sm="4" cols="12">
                    <app-select-field
                      label="Quận huyện"
                      :items="districts"
                      v-model="modelDistrict"
                      listOfRules="required"
                      name="district"
                      :readonly="!forms.province && districts?.length == 1"
                      @onChange="onChangeDistrict"
                    >
                    </app-select-field>
                  </v-col>
                  <v-col sm="4" cols="12">
                    <app-select-field
                      label="Phường xã"
                      :items="wards"
                      v-model="modelWard"
                      listOfRules="required"
                      name="ward"
                      :readonly="
                        (!forms.province && districts?.length == 1) ||
                        (!forms.district && wards?.length == 1)
                      "
                    >
                    </app-select-field>
                  </v-col>
                  <v-col cols="12"
                    ><app-text-field
                      label="Mã Zip"
                      icon="tabler:zip"
                      v-model="modelZipCode"
                      name="zip_code"
                      listOfRules="required"
                    ></app-text-field
                  ></v-col>
                  <v-col cols="12">
                    <app-checkbox-field
                      v-model="modelDefault"
                      label="Đặt là địa chỉ mặc định?"
                      density="compact"
                      name="default"
                    >
                    </app-checkbox-field>
                  </v-col>
                  <v-col cols="12">
                    <div class="d-flex justify-content-end">
                      <OutlineButton @click="dialog = false" class="me-2"
                        >Hủy</OutlineButton
                      >
                      <AppButton
                        class="text-white d-flex align-items-center gap-2"
                        type="submit"
                        :disabled="submitLoading"
                        >{{
                          methodStatus ? "Thêm địa chỉ" : "Cập nhật địa chỉ"
                        }}
                        <VProgressCircular
                          indeterminate
                          color="white"
                          :width="2"
                          :size="20"
                          v-if="submitLoading"
                      /></AppButton>
                    </div>
                  </v-col>
                </v-row>
              </Form>
            </template>
          </Modal>
          <Modal
            v-model:model-value="deleteDialog"
            title="Xóa địa chỉ"
            size="400"
          >
            <template v-slot:body>
              <v-card-item>
                <v-row>
                  <v-col cols="12"
                    ><p>Bạn có chắc chắn muốn xóa địa chỉ này không?</p></v-col
                  >
                  <v-col cols="12">
                    <div class="d-flex justify-content-end">
                      <OutlineButton @click="deleteDialog = false" class="me-2"
                        >Hủy</OutlineButton
                      >
                      <AppButton
                        bg="bg-danger"
                        type="submit"
                        :disabled="deleteLoading"
                        @click="onDelete"
                        >Xóa địa chỉ
                        <VProgressCircular
                          indeterminate
                          color="white"
                          :width="2"
                          :size="20"
                          v-if="deleteLoading"
                      /></AppButton>
                    </div>
                  </v-col>
                </v-row>
              </v-card-item>
            </template>
          </Modal>
          <v-row class="mt-2" v-if="loading">
            <v-divider></v-divider>
            <v-col cols="12">
              <v-skeleton-loader
                max-width="500"
                type="text,text,text,text"
              ></v-skeleton-loader>
            </v-col>
            <v-divider></v-divider>
            <v-col cols="12">
              <v-skeleton-loader
                max-width="500"
                type="text,text,text,text"
              ></v-skeleton-loader>
            </v-col>
          </v-row>
          <div v-else>
            <div v-for="(item, inx) in address" :key="inx">
              <v-row class="mt-2">
                <v-divider></v-divider>
                <v-col cols="12" md="9">
                  <div class="col-right-ac">
                    <p>
                      <strong>Họ tên: </strong>{{ item.name }}
                      <span v-if="item.default == true" class="default-address"
                        >Địa chỉ mặc định</span
                      >
                    </p>
                    <p><strong>Địa chỉ: </strong>{{ item.full_address }}</p>
                    <p>
                      <strong>Số điện thoại: </strong>{{ item.phone_number }}
                    </p>
                    <p><strong>Công ty: </strong>{{ item.company }}</p>
                  </div>
                </v-col>
                <v-col cols="12" md="3" class="mx-auto my-auto">
                  <div class="address-action">
                    <AppButton
                      class="p-14 me-2"
                      :bg-none="$vuetify.display.width > 960"
                      @click="onUpdateAddress(item)"
                      >Chỉnh sửa địa chỉ</AppButton
                    >
                    <AppButton
                      class="p-14 text-danger"
                      bg="btn-danger"
                      :bg-none="$vuetify.display.width > 960"
                      @click="handleDeleteAddress(item)"
                      >Xóa</AppButton
                    >
                  </div>
                </v-col>
              </v-row>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script lang="ts">
import * as yup from "yup";
import {
  getProvince,
  getDistrictByProvince,
  getWardByDistrict,
  phoneNumberValidator,
  getProvinceById,
  getDistrictById,
  getWardById,
} from "@/core";
import type { TreeType, District } from "@/core";
import type { Address } from "~/models";
import type { RESPONSE_DATA_SUCCESS } from "~/types";
export default {
  setup() {
    const provinces = getProvince();
    const schema = yup.object({
      name: yup.string().required(),
    });
    useHead({
      title: "Sổ địa chỉ",
      meta: [
        {
          name: "",
          content: "",
        },
      ],
    });
    const address = ref<Address[]>([]);
    const initialForms = {
      name: "",
      phone_number: "",
      company: "",
      address: "",
      province: "",
      district: "",
      ward: "",
      zip_code: "",
      default: false,
    };
    const forms = reactive({ ...initialForms });
    return {
      provinces,
      phoneNumberValidator,
      schema,
      getProvinceById,
      getDistrictById,
      getWardById,
      address,
      initialForms,
      forms,
    };
  },
  head() {
    return {
      title: "Sổ địa chỉ",
      meta: [
        {
          name: "description",
          content: "This is my page description.",
        },
      ],
    };
  },
  data() {
    return {
      breadcrumbs: [
        { to: "/", name: "Trang chủ", active: false },
        { to: "/customer", name: "Trang khách hàng", active: false },
        { to: "/customer/address", name: "Sổ địa chỉ", active: true },
      ],
      dialog: false,
      updateForms: {
        id: -1,
        name: "",
        phone_number: "",
        company: "",
        address: "",
        province: "",
        district: "",
        ward: "",
        zip_code: "",
        default: false,
        user_id: -1,
      },
      districts: [{}],
      wards: [{}],
      validate: false,
      loading: true,
      submitLoading: false,
      methodStatus: false,
      addressStatus: false,
      deleteDialog: false,
      selectedAddressId: -1,
      deleteLoading: false,
    };
  },

  mounted() {
    this.fetch();
  },
  methods: {
    onChangeProvince(value: keyof TreeType): void {
      this.districts = [{}];
      if (this.methodStatus) {
        this.forms.district = "";
        this.forms.ward = "";
      } else {
        this.updateForms.district = "";
        this.updateForms.ward = "";
      }
      this.wards = [{}];
      this.districts = getDistrictByProvince(value);
      if (!this.methodStatus) {
        this.addressStatus = true;
      }
    },
    onChangeDistrict(value: keyof District): void {
      this.wards = [{}];
      let province = this.forms.province as keyof TreeType;
      if (this.methodStatus) {
        this.forms.ward = "";
      } else {
        this.updateForms.ward = "";
        province = this.updateForms.province as keyof TreeType;
      }
      this.wards = getWardByDistrict(province, value);
    },
    async onSubmit() {
      if (this.methodStatus) {
        try {
          this.submitLoading = true;
          const data = { ...this.forms };
          data.province = this.getProvinceById(this.forms.province);
          data.district = this.getDistrictById(
            this.forms.district,
            this.districts
          );
          data.ward = this.getWardById(this.forms.ward, this.wards);
          const response = await this.$axios.post<
            Address,
            Omit<
              Address,
              "id" | "user_id" | "updated_at" | "created_at" | "full_address"
            >
          >("user/addresses", data);
          this.$notify({
            title: response.data.message,
            type: "success",
          });
          this.dialog = false;
          this.fetch();
        } catch (e) {
          this.$notify({
            title: "Thêm địa chỉ không thành công!",
            type: "error",
          });
        } finally {
          this.submitLoading = false;
        }
      } else {
        this.onUpdate();
      }
    },
    onUpdateAddress(item: Address) {
      const newData = { ...item };
      delete newData.created_at;
      delete newData.updated_at;
      delete newData.full_address;
      this.updateForms = { ...newData };
      this.methodStatus = false;
      this.dialog = true;
      this.resetForm();
    },
    async onUpdate() {
      try {
        let urlUpdate = `user/address/${this.updateForms.id}`;
        this.submitLoading = true;
        const data = { ...this.updateForms } as Omit<Address, "id"> & {
          id?: number;
        };
        delete data.id;
        if (this.addressStatus) {
          data.province = this.getProvinceById(this.updateForms.province);
          data.district = this.getDistrictById(
            this.updateForms.district,
            this.districts
          );
          data.ward = this.getWardById(this.updateForms.ward, this.wards);
        }
        const response = await this.$axios.put<
          Address,
          Omit<
            Address,
            "id" | "user_id" | "updated_at" | "created_at" | "full_address"
          >
        >(urlUpdate, data);
        this.$notify({
          title: "Cập nhật thành công!",
          type: "success",
        });
        this.dialog = false;
        this.fetch();
        this.addressStatus = false;
      } catch (e) {
        this.$notify({
          title: "Cập nhật thất bại!",
          type: "error",
        });
      } finally {
        this.submitLoading = false;
      }
    },
    async fetch() {
      try {
        this.loading = true;
        const response = await this.$axios.get<
          RESPONSE_DATA_SUCCESS<Address[]>
        >("user/addresses");
        this.address = response.data.data;
      } catch (e) {
        this.$notify({
          title: "Lấy danh sách địa chỉ thất bại!",
          type: "error",
        });
      } finally {
        this.loading = false;
      }
    },
    resetForm() {
      this.forms.name = "";
      this.forms.phone_number = "";
      this.forms.company = "";
      this.forms.address = "";
      this.forms.province = "";
      this.forms.district = "";
      this.forms.ward = "";
      this.forms.zip_code = "";
      this.forms.default = false;
      this.districts = [{}];
      this.wards = [{}];
    },
    handleDeleteAddress(item: Address) {
      this.selectedAddressId = item.id;
      this.deleteDialog = true;
    },
    async onDelete() {
      try {
        this.deleteLoading = true;
        const response = await this.$axios.delete(`user/address/${this.selectedAddressId}`);
        this.selectedAddressId = -1;
        this.deleteDialog = false;
        this.fetch();
        this.$notify({
          title: "Xóa địa chỉ thành công!",
          type: "success",
        });
      } catch (e) {
        this.$notify({
          title: "Xóa địa chỉ thất bại!",
          type: "error",
        });
      } finally {
        this.deleteLoading = false;
      }
    }
  },
  computed: {
    modelName: {
      get() {
        return this.methodStatus ? this.forms.name : this.updateForms.name;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.name = value;
        } else {
          this.updateForms.name = value;
        }
      },
    },
    modelPhoneNumber: {
      get() {
        return this.methodStatus
          ? this.forms.phone_number
          : this.updateForms.phone_number;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.phone_number = value;
        } else {
          this.updateForms.phone_number = value;
        }
      },
    },
    modelCompany: {
      get() {
        return this.methodStatus
          ? this.forms.company
          : this.updateForms.company;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.company = value;
        } else {
          this.updateForms.company = value;
        }
      },
    },
    modelAddress: {
      get() {
        return this.methodStatus
          ? this.forms.address
          : this.updateForms.address;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.address = value;
        } else {
          this.updateForms.address = value;
        }
      },
    },
    modelProvince: {
      get() {
        return this.methodStatus
          ? this.forms.province
          : this.updateForms.province;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.province = value;
        } else {
          this.updateForms.province = value;
        }
      },
    },
    modelDistrict: {
      get() {
        return this.methodStatus
          ? this.forms.district
          : this.updateForms.district;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.district = value;
        } else {
          this.updateForms.district = value;
        }
      },
    },
    modelWard: {
      get() {
        return this.methodStatus ? this.forms.ward : this.updateForms.ward;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.ward = value;
        } else {
          this.updateForms.ward = value;
        }
      },
    },
    modelZipCode: {
      get() {
        return this.methodStatus
          ? this.forms.zip_code
          : this.updateForms.zip_code;
      },
      set(value: string) {
        if (this.methodStatus) {
          this.forms.zip_code = value;
        } else {
          this.updateForms.zip_code = value;
        }
      },
    },
    modelDefault: {
      get() {
        return this.methodStatus
          ? this.forms.default
          : this.updateForms.default;
      },
      set(value: boolean) {
        if (this.methodStatus) {
          this.forms.default = value;
        } else {
          this.updateForms.default = value;
        }
      },
    },
  },
};
</script>

<style lang="scss">
.default-address {
  font-size: 10px;
  color: #27ae60;
  padding-left: 10px;
}
.address-action {
  display: flex;
  flex-direction: row;
}
</style>
