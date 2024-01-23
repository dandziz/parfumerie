import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'

export default defineNuxtPlugin((app) => {
  const vuetify = createVuetify({
    ssr: false,
    theme: {
      themes: {
        light: {
          colors: {
            success: '#07503d'
          }
        },
      },
    },
  })
  app.vueApp.use(vuetify)
})
