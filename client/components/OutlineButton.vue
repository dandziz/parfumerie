<template>
  <component
    :is="renderedComponent"
    :type="type"
    class="btn btn-outline-light rounded-0"
  >
    <slot></slot>
  </component>
</template>

<script>
export default {
  props: {
    componentType: {
      type: String,
      default: 'button'
    },
    to: {
      type: String,
      default: '',
    },
    type: {
      type: String,
      default: 'button'
    }
  },
  computed: {
    renderedComponent() {
      if (this.componentType === 'button') {
        return 'button';
      } else if (this.componentType === 'link') {
        return defineNuxtLink({});
      } else {
        return 'div';
      }
    },
  },
}
</script>
