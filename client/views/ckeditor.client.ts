import CKEditor from '@ckeditor/ckeditor5-vue';
import Editor from '@/core/lib/CustomEditor';

export default defineNuxtPlugin(() => {
  return {
      provide: {
          ckeditor: {
            classic: Editor,
            editor: CKEditor
          }
      }
  }
});
