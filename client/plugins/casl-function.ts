import ability from '@/configs/casl'

export default defineNuxtPlugin((nuxtApp) => {

    return {
        provide: {
          ability
        }
    }
})


