<template>
  <div>
    <client-only placeholder="loading...">
      <CkeditorNuxt value="editorInput" @input="event => editorInput = event" />
    </client-only>
    {{ editorInput }}
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  setup () {
    

    return {}
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
