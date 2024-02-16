import cookies from 'js-cookie';

export default defineNuxtPlugin((nuxtApp) => {
    return {
        provide: {
          cookies
        }
    }
})
