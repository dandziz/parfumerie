<template>
  <v-pagination
    :model-value="modelValue"
    class="my-4"
    :length="length"
    :total-visible="displayPaginate"
    @update:modelValue="onUpdatePage"
  ></v-pagination>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
  setup () {
    return {}
  },
  props: {
    modelValue: {
      type: Number,
      required: true,
    },
    length: {
      type: Number,
      required: true,
    }
  },
  computed: {
    displayPaginate() {
      if (this.$vuetify.display.width > 1280) return 7;
      else if (
        this.$vuetify.display.width <= 1280 &&
        this.$vuetify.display.width > 1200
      )
        return 6;
      else if (
        this.$vuetify.display.width <= 1200 &&
        this.$vuetify.display.width > 960
      )
        return 4
      else if (
        this.$vuetify.display.width <= 960 &&
        this.$vuetify.display.width > 480
      )
        return 6
      else return 3;
    },
  },
  methods: {
    onUpdatePage(page: number) {
      this.$emit('update:modelValue', page)
    }
  },
})
</script>

<style scoped>

</style>
