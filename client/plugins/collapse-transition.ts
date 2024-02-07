import CollapseTransition from '@ivanv/vue-collapse-transition/src/CollapseTransition.vue'

export default defineNuxtPlugin((app) => {
  app.vueApp.component('CollapseTransition', CollapseTransition)
})
