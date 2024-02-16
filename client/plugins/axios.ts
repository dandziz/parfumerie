import AxiosRepository from "~/httpRequest/AxiosRepository";

export default defineNuxtPlugin((nuxtApp) => {
  const axios = new AxiosRepository();
    return {
        provide: {
          axios
        }
    }
})


