import cookies from 'js-cookie';

export default defineNuxtPlugin((nuxtApp) => {
  const axios = new AxiosRepository();
    return {
        provide: {
          cookies
        }
    }
})
