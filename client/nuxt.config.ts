import vuetify, { transformAssetUrls } from "vite-plugin-vuetify";
// https://nuxt.com/docs/api/configuration/nuxt-config
export default {
  devtools: { enabled: true },
  css: [
    "bootstrap/dist/css/bootstrap.css",
    "./assets/css/header.css",
    "./assets/css/global.css",
  ],
  env: {
    BASE_URL: 'https://nuxtjs.org',
  },
  build: {
    transpile: ["vuetify"],
  },
  plugins: [
    './plugins/bootstrap.ts',
  ],
  modules: [
    (_options, nuxt) => {
      nuxt.hooks.hook(
        "vite:extendConfig",
        (config: { plugins: Plugin[][] }) => {
          config.plugins?.push(vuetify({ autoImport: true }));
        }
      );
    },
    "nuxt-icon"
  ],
  veeValidate: {
    autoImports: true,
    componentNames: {
      Form: 'VeeForm',
      Field: 'VeeField',
      FieldArray: 'VeeFieldArray',
      ErrorMessage: 'VeeErrorMessage',
    },
  },
  vite: {
    vue: {
      template: {
        transformAssetUrls,
      },
    },
  }
};
