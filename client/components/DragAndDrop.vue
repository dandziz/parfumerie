<template>
  <div class="drag-and-drop">
    <div class="top">
      <p class="text-uppercase m-0">Kéo và thả hình ảnh</p>
      <span class="p-12 text-gray" v-if="maxSize">Kích thước hình ảnh không được vượt quá {{ maxSize / 1000000 }}MB</span>
      <span class="p-12 text-gray" v-if="maxFile"> và tối đa được tải lên {{ maxFile }} ảnh</span>
    </div>
    <div
      class="drag-area"
      @dragover.prevent="onDragOver"
      @dragleave.prevent="onDragLeave"
      @drop.prevent="onDrop"
    >
      <span v-if="!isDragging"
        >Kéo hình ảnh vào đây hoặc
        <span class="drag-area-select" role="button" @click="selectFiles"
          >Tải lên</span
        >
      </span>
      <div class="drag-area-select" v-else>Thả hình ảnh vào đây</div>
      <v-file-input
        accept="image/*"
        class="drag-input"
        ref="fileInput"
        multiple
        @update:model-value="onInputFiles"
      ></v-file-input>
    </div>
    <div class="drag-container">
      <div class="drag-image" v-for="(image, index) in images" :key="index">
        <span class="delete" @click="deleteImage(index)">&times;</span>
        <img :src="image.url" />
        <v-tooltip activator="parent" location="top">{{ image.name }}</v-tooltip>
      </div>
    </div>
    <div class="details">
      <div
        class="v-messages"
        role="alert"
        aria-live="polite"
      ><div class="v-messages__message" :class="{ 'text-danger' : errorMessages }">{{ errorMessages || errorMessage }}</div></div>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";
import type { IMAGE } from "@types";

export default defineComponent({
  setup() {
    const images = reactive<Array<IMAGE>>([]);
    const files = reactive<Array<File>>([]);
    return {
      images,
      files,
    };
  },
  props: {
    modelValue: {
      type: Array<File>,
      required: true,
    },
    maxSize: {
      type: Number,
    },
    maxFile: {
      type: Number,
    },
    errorMessages: {
      type: String,
    },
  },
  data() {
    return {
      isDragging: false,
      errorMessage: '',
    };
  },
  methods: {
    selectFiles() {
      (this.$refs.fileInput as HTMLElement).click();
    },
    onInputFiles(files: Array<File>) {
      if (!files || files.length === 0) return;
      this.errorMessage = "";
      if (this.maxFile && this.maxFile == this.files.length) {
        this.errorMessage = `Đã đạt đến số lượng tối đa ${this.maxFile} ảnh!`;
        return;
      }
      for (let i = 0; i < files.length; i++) {
        if (files[i].type.split("/")[0] != "image") continue;
        if (this.maxFile && this.maxFile == this.files.length) {
            this.errorMessage = `Một số hình ảnh đã bị loại bỏ do đã đạt đến số lượng tối đa ${this.maxFile} ảnh!`;
            break;
          }
        if (!this.images.some((e) => e.name === files[i].name)) {
          if (this.maxSize && files[i].size > this.maxSize) {
            this.errorMessage = `Một số hình ảnh đã bị loại bỏ do kích thước vượt quá ${this.maxSize / 1000000}MB!`
            continue;
          }
          this.images.push({
            name: files[i].name,
            url: URL.createObjectURL(files[i]),
          });
          this.files.push(files[i]);
        }
      }
      this.$emit("update:modelValue", this.files);
      this.$emit("update:errorMessages", "");
    },
    deleteImage(index: number) {
      this.errorMessage = "";
      URL.revokeObjectURL(this.images[index].url);
      this.images.splice(index, 1);
      this.files.splice(index, 1);
      this.$emit("update:modelValue", this.files);
      this.$emit("update:errorMessages", "");
    },
    onDragOver(event: DragEvent) {
      event.preventDefault();
      this.isDragging = true;
      if (event.dataTransfer?.dropEffect) {
        event.dataTransfer.dropEffect = "copy";
      }
    },
    onDragLeave(event: DragEvent) {
      event.preventDefault();
      this.isDragging = false;
    },
    onDrop(event: DragEvent) {
      event.preventDefault();
      this.isDragging = false;
      const files = event.dataTransfer?.files;
      if (!files || files.length === 0) return;
      if (files) {
        this.errorMessage = "";
        if (files.length === 0) return;
        if (this.maxFile && this.maxFile == this.files.length) {
          this.errorMessage = `Đã đạt đến số lượng tối đa ${this.maxFile} ảnh!`;
          return;
        }
        for (let i = 0; i < files.length; i++) {
          if (files[i].type.split("/")[0] != "image") continue;
          if (this.maxFile && this.maxFile == this.files.length) {
              this.errorMessage = `Một số hình ảnh đã bị loại bỏ do đã đạt đến số lượng tối đa ${this.maxFile} ảnh!`;
              break;
            }
          if (!this.images.some((e) => e.name === files[i].name)) {
            if (this.maxSize && files[i].size > this.maxSize) {
              this.errorMessage = `Một số hình ảnh đã bị loại bỏ do kích thước vượt quá ${this.maxSize / 1000000}MB!`
              continue;
            }
            this.images.push({
              name: files[i].name,
              url: URL.createObjectURL(files[i]),
            });
            this.files.push(files[i]);
          }
        }
        this.$emit("update:modelValue", this.files);
        this.$emit("update:errorMessages", "");
      }
    },
    resetImages() {
      for (let i = 0; i < this.images.length; i++) {
        URL.revokeObjectURL(this.images[i].url);
      }
      this.images = []
      this.$emit("update:modelValue", []);
    }
  },
});
</script>

<style lang="scss">
.drag-and-drop {
  margin: 5px auto;
  width: 99.5%;
  padding: 10px;
  box-shadow: 0 0 5px rgb(118, 118, 118);
  border-radius: 5px;
  overflow: hidden;

  .top {
    text-align: center;
  }
  p {
    font-weight: bold;
  }
  .drag-area {
    height: 150px;
    border-radius: 5px;
    border: 2px dashed rgb(118, 118, 118);
    background: #f4f3f9;
    color: rgb(118, 118, 118);
    display: flex;
    justify-content: center;
    align-items: center;
    user-select: center;
    -webkit-user-select: none;
    margin-top: 10px;
    .visible {
      font-size: 18px;
    }
  }
  .drag-area-select {
    color: #1867c0;
    margin-left: 5px;
    cursor: pointer;
    transition: 0.4s;
    &:hover {
      opacity: 0.6;
    }
  }
  .drag-container {
    width: 100%;
    height: auto;
    display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    flex-wrap: wrap;
    max-height: 216px;
    position: relative;
    margin-bottom: 8px;
    .drag-image {
      width: 100px;
      margin-right: 5px;
      height: 100px;
      position: relative;
      margin-top: 8px;
      img {
        width: 100%;
        height: 100%;
        border-radius: 5px;
        object-fit: cover;
      }
      span {
        position: absolute;
        top: -2px;
        right: 9px;
        font-size: 20px;
        cursor: pointer;
      }
    }
  }
  & .drag-input,
  & .drag-area .on-drop,
  & .drag-area-dragover .visible {
    display: none;
  }
  .delete {
    z-index: 999;
    color: #fe0000;
    -webkit-user-select: none;
  }
  .details {
    padding-inline: 16px;
    padding-top: 6;
    .v-messages {
      opacity: 1;
    }

    .v-messages__message {
      color: #2196F3;
    }
  }
}
</style>
