import vuetify, { transformAssetUrls } from "vite-plugin-vuetify";
// https://nuxt.com/docs/api/configuration/nuxt-config
export default {
  ssr: false,
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
    (_options: any, nuxt: { hooks: { hook: (arg0: string, arg1: (config: { plugins: Plugin[][]; }) => void) => void; }; }) => {
      nuxt.hooks.hook(
        "vite:extendConfig",
        (config: { plugins: Plugin[][] }) => {
          return config.plugins?.push(vuetify({ autoImport: true }));
        }
      );
    },
    '@vee-validate/nuxt',
    "nuxt-icon",
    '@nuxtjs/i18n'
  ],
  vite: {
    vue: {
      template: {
        transformAssetUrls,
      },
    },
  },
  i18n: {
    vueI18n: './configs/i18n'
  }
};
