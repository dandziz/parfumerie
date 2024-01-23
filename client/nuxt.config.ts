import vuetify, { transformAssetUrls } from "vite-plugin-vuetify";
import { fileURLToPath } from "url";
// https://nuxt.com/docs/api/configuration/nuxt-config
export default {
  ssr: false,
  devtools: { enabled: true },
  css: [
    "bootstrap/dist/css/bootstrap.css",
    "./assets/css/header.css",
    "./assets/css/global.css",
  ],
  buildModules: ["@nuxtjs/style-resources"],
  styleResources: {
    scss: ["./assets/vars/*.scss", "./assets/abstracts/_mixins.scss"],
  },
  env: {
    BASE_URL: "https://nuxtjs.org",
  },
  build: {
    transpile: ["vuetify"],
  },
  plugins: [],
  modules: [
    (
      _options: any,
      nuxt: {
        hooks: { hook: (arg0: string, arg1: (config: any) => void) => void };
      }
    ) => {
      nuxt.hooks.hook("vite:extendConfig", (config) => {
        config.plugins.push(vuetify({ autoImport: true }));
      });
    },
    "@vee-validate/nuxt",
    "nuxt-icon",
    "@nuxtjs/i18n",
    "nuxt-swiper",
  ],
  vite: {
    vue: {
      template: {
        transformAssetUrls,
      },
    },
    css: {
      preprocessorOptions: {
        scss: {
          additionalData: `@use "~/assets/vars/_colors.scss" as *;
                          @use "~/assets/abstracts/_mixins.scss" as *;
          `,
        },
      },
    },
  },
  i18n: {
    vueI18n: "./configs/i18n",
  },
  alias: {
    "~assets": "assets",
  },
  vuetify: {
    treeShake: true,
    customVariables: ["~/assets/styles/variables/_vuetify.scss"],
  },
};
