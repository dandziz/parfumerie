export default defineNuxtPlugin((nuxtApp) => {
  const axios = new AxiosRepository();
    return {
        provide: {
          axios
        }
    }
})


