import { abilitiesPlugin } from '@casl/vue';
import ability from '~/configs/casl';

export default defineNuxtPlugin((app) => {
  app.vueApp.use(abilitiesPlugin, ability)
})
