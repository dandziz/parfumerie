import '@mdi/font/css/materialdesignicons.css'
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import { vi } from 'vuetify/locale'

export default defineNuxtPlugin((app) => {
  const vuetify = createVuetify({
    ssr: false,
    theme: {
      themes: {
        light: {
          colors: {
            success: '#07503d',
          }
        },
      },
    },
    locale: {
      locale: 'vi',
      messages: { vi }
    },
  })
  app.vueApp.use(vuetify)
})
