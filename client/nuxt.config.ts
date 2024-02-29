import vuetify, { transformAssetUrls } from "vite-plugin-vuetify";
import { fileURLToPath } from "url";
import ckeditor5 from '@ckeditor/vite-plugin-ckeditor5';
import { createRequire } from 'node:module';
const require = createRequire(import.meta.url);
// https://nuxt.com/docs/api/configuration/nuxt-config
export default {
  ssr: false,
  devtools: { enabled: true },
  css: [
    "bootstrap/dist/css/bootstrap.css",
    "./assets/css/global.css",
    "nprogress/nprogress.css",
  ],
  buildModules: ["@nuxtjs/style-resources"],
  styleResources: {
    scss: ["./assets/vars/*.scss", "./assets/abstracts/_mixins.scss"],
  },
  env: {
    BASE_URL: "https://nuxtjs.org",
  },
  runtimeConfig: {
    public: {
      apiBase: process.env.API_BASE_URL
    }
  },
  build: {
    transpile: ["vuetify"],
  },
  plugins: [],
  app: {
    pageTransition: { name: "page", mode: "in-out" },
  },
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
    "nuxt3-notifications",
    "nuxt-vue3-google-signin"
  ],
  vite: {
    vue: {
      template: {
        transformAssetUrls,
      },
    },
    plugins: [
      ckeditor5({
        theme: require.resolve("@ckeditor/ckeditor5-theme-lark"),
      }),
    ],
  },
  i18n: {
    vueI18n: "./configs/i18n",
  },
  alias: {
    "~assets": fileURLToPath(new URL("./assets", import.meta.url)),
    "@types": fileURLToPath(new URL("./types/index.ts", import.meta.url)),
    "@axios": fileURLToPath(
      new URL("./configs/axios.config.ts", import.meta.url)
    ),
    "@config": fileURLToPath(new URL("./configs", import.meta.url)),
    "@validator": fileURLToPath(
      new URL("./core/validator/validators.ts", import.meta.url)
    ),
  },
  vuetify: {
    treeShake: true,
    customVariables: ["~/assets/styles/variables/_vuetify.scss"],
    lang: {
      current: "vi",
    },
  },
  nuxtNotifications: {
    componentName: "AppNotifications",
  },
  googleSignIn: {
    clientId: process.env.NUXT_PUBLIC_GOOGLE_CLIENT_ID,
  }
};
