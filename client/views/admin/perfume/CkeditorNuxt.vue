<template>
  <client-only placeholder="loading...">
    <ckeditor
      :config="config"
      :editor="editor"
      v-bind="{
        ...$attrs,
      }"
      @input="emitInput"
    />
  </client-only>
</template>
<script setup>
import CKEditor from "@ckeditor/ckeditor5-vue";
import Editor from "@/core/lib/CustomEditor";

const emit = defineEmits(["update:modelValue"]);
const emitInput = (event) => {
  emit("update:modelValue", event);
};
//const { $ckeditor } = useNuxtApp()
//const ckeditor = $ckeditor.editor.component;
//const editor = $ckeditor.classic;
//const config = $ckeditor.config;
const ckeditor = CKEditor.component;
const editor = Editor;
const config = CKEditor.config;
</script>
