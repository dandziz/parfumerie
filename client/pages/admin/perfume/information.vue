<template>
  <div>
    <client-only placeholder="loading...">
      <CkeditorNuxt value="editorInput" @input="event => editorInput = event" />
    </client-only>
    <template v-html="editorInput">
    </template>
    {{ editorInput }}
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'
import CkeditorNuxt from '@/views/admin/perfume/CkeditorNuxt.vue'
export default defineComponent({
  setup () {
    

    return {}
  },
  components: {
    CkeditorNuxt
  },
  data() {
    return {
      editorInput: ''
    }
  },
})
</script>

<style scoped>

</style>
