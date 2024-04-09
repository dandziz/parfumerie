<template>
  <div class="d-flex" :class="{'quantity-wrapper' : size=='large', 'quantity-wrapper-small' : size=='small',}">
    <div class="input-group-prepend">
      <button @click="handleReduce" class="left" :disabled="disabled">-</button>
    </div>
    <v-text-field
      label=""
      :model-value="modelValue"
      variant="plain"
      density="compact"
      name="count"
      class="hidden-details input-number border"
      min="1"
      type="number"
      @update:modelValue="onInput"
      :disabled="disabled"
    ></v-text-field>
    <div class="input-group-prepend">
      <button :disabled="disabled" @click="handleIncrease" class="right">+</button>
    </div>
  </div>
</template>

<script lang="ts">
import { defineComponent } from "vue";

export default defineComponent({
  setup() {
    return {};
  },
  props: {
    modelValue: {
      type: Number,
      required: true,
    },
    size: {
      type: String,
      default: 'small'
    },
    config: {
      type: Boolean,
      default: false
    },
    disabled: {
      type: Boolean,
      default: false
    },
    max: {
      type: Number,
      default: 100
    }
  },
  methods: {
    onInput(value: string) {
      if (value && !isNaN(Number(value))) {
        const newValue = parseInt(value)
        if (newValue >= 1 && !this.config && newValue <= this.max)
          this.$emit('update:modelValue', newValue)
        else if (newValue >= 1 && newValue <= this.max)
          this.$emit('onChange', newValue)
      }
    },
    handleIncrease() {
      if (!this.config && this.modelValue < this.max)
        this.$emit('update:modelValue', this.modelValue + 1)
      else if (this.modelValue < this.max)
        this.$emit('onIncrease')
    },
    handleReduce() {
      if (this.modelValue > 1 && !this.config)
        this.$emit('update:modelValue', this.modelValue - 1)
      else if (this.modelValue > 1)
        this.$emit('onReduce')
    }
  },
});
</script>

<style lang="scss">
.quantity-wrapper {
  margin-top: 6px;
  .input-number {
    height: 40px;
    font-size: 1em;
    margin: 0;
    max-width: 80px;
    min-width: 80px;
    padding: 0 2px;
    input {
      text-align: center;
    }
  }
  .input-group-prepend {
    font-size: 20px;
    button {
      width: 40px;
      height: 40px;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
      &:hover {
        background-color: var(--green);
        color: var(--white);
      }
      &:active {
        border-color: var(--bs-btn-active-border-color);
      }
    }
    .right {
      border-right: 1px solid var(--border-color);
      border-radius: 0 4px 4px 0;
    }
    .left {
      border-left: 1px solid var(--border-color);
      border-radius: 4px 0 0 4px;
    }
  }
}
.quantity-wrapper-small {
  .input-number {
    height: 28px;
    font-size: 1em;
    margin: 0;
    max-width: 50px;
    min-width: 50px;
    padding: 0 2px;
    input {
      text-align: center;
      padding: 0;
      min-height: 28px;
    }
  }
  .input-group-prepend {
    font-size: 14px;
    button {
      width: 28px;
      height: 28px;
      border-top: 1px solid var(--border-color);
      border-bottom: 1px solid var(--border-color);
    }
    .right {
      border-right: 1px solid var(--border-color);
      border-radius: 0 4px 4px 0;
      padding: 3px 9px;
      line-height: 2px;
    }
    .left {
      border-left: 1px solid var(--border-color);
      border-radius: 4px 0 0 4px;
      padding: 3px 9px;
      line-height: 2px;
    }
  }
}
</style>
