<template>
  <client-only placeholder="loading...">
    <ckeditor :config="config" :editor="editor" :value="value" @input="emitInput" />
  </client-only>
</template>
<script setup>
import CKEditor from '@ckeditor/ckeditor5-vue';
import Editor from '@/core/lib/CustomEditor';
defineProps({
  value: {
    type: String
  }
})
const emit = defineEmits(['input'])
const emitInput = (event) => {
  emit("input", event)
}
//const { $ckeditor } = useNuxtApp()
//const ckeditor = $ckeditor.editor.component;
//const editor = $ckeditor.classic;
//const config = $ckeditor.config;
const ckeditor = CKEditor.component
const editor = Editor
const config = CKEditor.config

</script>
