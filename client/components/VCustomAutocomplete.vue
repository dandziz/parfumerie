<template>
  <div class="p-14">
    <div class="form-label fw-bold">{{ label }}</div>
    <v-autocomplete
      :model-value="modelValue"
      density="compact"
      variant="outlined"
      :color="color"
      :placeholder="placeholder"
      :items="items"
      :readonly="readonly"
      @update:modelValue="onInput"
    >
      <template v-if="icon" v-slot:prepend-inner
        ><Icon :name="icon" size="24" class="icon-color"
      /></template>
    </v-autocomplete>
  </div>
</template>

<script lang="ts">
export default {
  setup() {
    return {};
  },
  props: {
    items: {
      type: Array,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
    placeholder: {
      type: String,
      default: "",
    },
    icon: {
      type: String,
    },
    modelValue: {
      type: String,
      required: true,
    },
    readonly: {
      type: Boolean,
      default: false,
    }
  },
  data() {
    return {};
  },
  methods: {
    onInput(value: string) {
      if (value) {
        this.$emit("update:modelValue", value);
        this.$emit("onChange", value);
      }
    },
  },
  computed: {
    color() {
      const col = this.readonly ? 'dark' : 'primary'
      return col
    }
  },
};
</script>

<style lang="scss" scoped>
.icon-color {
  color: rgb(200, 200, 200);
}
</style>
