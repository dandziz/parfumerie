<template>
  <v-card title="Quản lý hình ảnh cho nước hoa" class="position-relative">
    <VOverlay class="component-overlay" persistent contained v-model="loading">
      <VProgressCircular
        indeterminate
        color="primary"
        :width="2"
        :size="50"
        class="text-success"
      />
    </VOverlay>
    <modal v-model="dialog" size="600">
      <template v-slot:body>
        <img :src="showImage" class="mt-2" />
      </template>
    </modal>
    <v-card-item>
      <draggable class="v-row flex-row" :list="images" @change="log">
        <transition-group name="list">
          <v-col cols="6" sm="3" v-for="(image, index) in images" :key="index">
            <v-card
              class="mx-auto position-relative"
              max-width="200"
              height="200"
              :image="image.img_link"
              theme="dark"
              @click="
                dialog = true;
                showImage = image.img_link;
              "
            >
              <p
                class="image-type"
                :class="{
                  'bg-warning': image.type == 0,
                  'bg-primary': image.type == 1,
                  'bg-danger': image.type == 2,
                  'bg-secondary': image.type == 3,
                }"
              >
                {{ ImageType[image.type] }}
              </p>
              <p class="image-index bg-black">
                {{ image.img_sort }}
              </p>
            </v-card>
            <div>
              <v-menu
                content-class="v-menu-mixin"
                transition="slide-y-transition"
              >
                <template v-slot:activator="{ props }">
                  <p
                    class="text-center p-14 mb-2 mt-2 cursor-pointer text-primary image-action"
                    v-bind="props"
                  >
                    Thay đổi
                  </p>
                </template>
                <v-list class="p-0">
                  <template v-for="(value, i) in actionItems" :key="i">
                    <v-list-item
                      v-if="value.type != image.type"
                      @click="value.click(image.id, value.type)"
                    >
                      <v-list-item-title>{{ value.title }}</v-list-item-title>
                    </v-list-item>
                  </template>
                </v-list>
              </v-menu>
            </div>
          </v-col>
        </transition-group>
      </draggable>
    </v-card-item>
    <v-card-item title="Ảnh" v-if="images.length < fileValidation.currentFile">
      <drag-and-drop
        ref="uploadImages"
        v-model="files"
        :max-size="fileValidation.maxSize"
        :max-file="fileValidation.maxFile"
        v-model:error-messages="errors.images"
        class="mt-2"
        :key="keyUploadImages"
      ></drag-and-drop>
      <v-card-actions>
        <v-spacer></v-spacer>
        <app-button @click="uploadImages">Thêm ảnh mới</app-button>
      </v-card-actions>
    </v-card-item>
    <v-card-actions class="gap-2">
      <v-spacer></v-spacer>
      <app-button bg="bg-danger" @click="reset">Reset</app-button>
      <app-button :disabled="!changes" @click="updateImageIndex"
        >Cập nhật lại vị trí hình ảnh</app-button
      >
    </v-card-actions>
  </v-card>
</template>

<script lang="ts">
import type { Image } from "@/models";
import type {
  RESPONSE_DATA_SUCCESS,
  RESPONSE_ERROR,
  RESPONSE_NOT_DATA,
} from "@types";
import { VueDraggableNext } from "vue-draggable-next";
import { ImageType } from "@/enums";
export default {
  setup() {
    const route = useRoute();
    const perfumeId = route.params.id as string;
    const { $axios } = useNuxtApp();
    const images = ref<Array<Image>>([]);
    const changes = ref<Boolean>(false);
    const files = reactive<Array<File>>([]);
    const fileValidation = reactive({
      maxSize: 10000000,
      maxFile: 0,
      currentFile: 10,
    });
    const fetch = async () => {
      try {
        const response = await $axios.get<RESPONSE_DATA_SUCCESS<Image[]>>(
          "admin/perfumes/" + perfumeId + "/images"
        );
        images.value = response.data.data;
        changes.value = false;
        fileValidation.maxFile =
          fileValidation.currentFile - response.data.data.length;
      } catch (e) {}
    };
    fetch();
    return {
      images,
      fetch,
      changes,
      ImageType,
      perfumeId,
      files,
      fileValidation,
    };
  },
  data() {
    return {
      actionItems: [
        { title: "Đặt làm mặc định", type: 1, click: this.setDefault },
        { title: "Đặt làm ảnh ML thường", type: 2, click: this.setDefault },
        {
          title: "Đặt làm ảnh FULLBOX",
          type: 3,
          click: this.setDefault,
        },
        {
          title: "Xóa ảnh",
          type: 4,
          click: this.deleteImage,
        },
      ],
      dialog: false,
      showImage: "",
      loading: false,
      keyUploadImages: String(Date.now()),
      errors: {
        images: "",
      },
    };
  },
  components: {
    draggable: VueDraggableNext,
  },
  mounted() {},
  methods: {
    log() {
      for (let i = 0; i < this.images.length; i++) {
        if (!(this.images[i].img_sort == i + 1)) {
          this.changes = true;
          return;
        }
      }
      this.changes = false;
    },
    reset() {
      this.images.sort((a: Image, b: Image) => {
        return a.img_sort - b.img_sort;
      });
      this.changes = false;
      if (this.$refs.uploadImages && (this.$refs.uploadImages as any)?.resetImages) {
        (this.$refs.uploadImages as any).resetImages();
        this.keyUploadImages = String(Date.now())
      }
    },
    async setDefault(id: number, type: number) {
      try {
        const actions = ["", "default", "ml", "fullbox"];
        this.loading = true;
        const response = await this.$axios.post<RESPONSE_NOT_DATA, any>(
          `admin/perfumes/${this.perfumeId}/${id}/${actions[type]}`
        );
        successfulNotification(
          convertStringToTitle(this.$t("success")),
          response.data.message
        );
        for (let i = 0; i < this.images.length; i++) {
          if (this.images[i].type == type) {
            this.images[i].type = 0;
            break;
          }
        }
        for (let i = 0; i < this.images.length; i++) {
          if (this.images[i].id == id) {
            this.images[i].type = type;
            break;
          }
        }
      } catch (e) {
        const error = e as RESPONSE_ERROR;
        failureNotification(
          convertStringToTitle(this.$t("failed")),
          error.message
        );
      } finally {
        this.loading = false;
      }
    },
    async deleteImage(id: number) {
      try {
        this.loading = true
        const response = await this.$axios.delete(`admin/perfumes/${this.perfumeId}/${id}`);
        this.images = this.images.filter((value) => value.id != id);
        successfulNotification('Xóa thành công!', 'Xóa hình ảnh thành công!');
        this.fileValidation.maxFile = this.fileValidation.currentFile - this.images.length
      } catch (e) {
        failureNotification('Lỗi!', 'Xóa hình ảnh thất bại!')
      } finally {
        this.loading = false
      }
    },
    async updateImageIndex() {
      if (this.changes) {
        try {
          this.loading = true
          const filter = this.images.map((value, index) => {
            return {
              id: value.id,
              img_sort: index + 1,
            };
          });
          const data = {
            array: [...filter],
          };
          const response = await this.$axios.post<
            RESPONSE_NOT_DATA,
            { [key: string]: Pick<Image, "id" | "img_sort">[] }
          >(`admin/perfumes/${this.perfumeId}/images/index`, data);
          for (let i = 0; i < this.images.length; i++) {
            this.images[i].img_sort = i + 1;
          }
          successfulNotification("Thành công!", response.data.message);
          this.changes = false;
        } catch (e) {
          const error = e as RESPONSE_ERROR;
          successfulNotification(
            error.message,
            "Cập nhật vị trí các hình ảnh thất bại."
          );
        } finally {
          this.loading = false
        }
      }
    },
    async uploadImages() {
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
      try {
        this.loading = true;
        let formData = new FormData();
        for (var i = 0; i < this.files.length; i++) {
          let file = this.files[i];
          formData.append("images[" + i + "]", file);
        }
        const response = await this.$axios.post<undefined, FormData>(
          `admin/perfumes/${this.perfumeId}/images`,
          formData,
          undefined,
          {
            "Content-Type": "multipart/form-data",
          }
        );
        this.fetch();
        this.reset();
      } catch (e) {
        const error = e as RESPONSE_ERROR;
        this.errors = error.error as typeof this.errors;
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style lang="scss">
.image-action {
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
.image-type,
.image-index {
  position: absolute;
  top: 0;
  font-size: 12px;
  padding: 4px;
  margin: 0;
  border-radius: 4px;
}
.image-type {
  left: 0;
}
.image-index {
  right: 0;
}
</style>
