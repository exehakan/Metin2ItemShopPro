import colors from 'vuetify/es5/util/colors'

export default {
  mode: 'universal',
  devtools: true,

  /*
  ** Headers of the page
  */
  head: {
    titleTemplate: '%s - ' + process.env.npm_package_name,
    title: process.env.npm_package_name || '',
    meta: [
      {lang: 'tr'},
      {charset: 'utf-8'},
      {name: 'viewport', content: 'width=device-width, initial-scale=1'},
      {hid: 'description', name: 'description', content: process.env.npm_package_description || ''}
    ],
    link: [
      {rel: 'icon', type: 'image/x-icon', href: '/metin2.ico'}
    ],
  },
  /*
  ** Customize the progress-bar color
  */
  loading: {color: 'brown'},
  /*
  ** Global CSS
  */
  css: [
    "~/assets/main.css",
    "~/assets/vuetify.css",
    // "~/node_modules/vuetify/src/styles/styles.sass"

  ],
  /*
  ** Plugins to load before mounting the App
  */
  plugins: [
    {src: "~/plugins/global.js"},
  ],
  /*
  ** Nuxt.js dev-modules
  */
  buildModules: [
    '@nuxtjs/vuetify',
    '@nuxtjs/universal-storage',
  ],

  /*
  ** Nuxt.js modules
  */
  modules: [
    '@nuxtjs/axios',
    // 'cookie-universal-nuxt',
  ],
  axios: {
    baseURL: "http://localhost/test/",
    // proxyHeaders: false,
    // credentials: false
    // baseURL: "http://corepvp.site/",
  },
  /*
  ** vuetify module configuration
  ** https://github.com/nuxt-community/vuetify-module
  */
  vuetify: {
    customVariables: ['~/assets/variables.scss'],
    theme: {
      dark: false,
      themes: {
        dark: {
          primary: colors.blue.darken2,
          accent: colors.grey.darken3,
          secondary: colors.amber.darken3,
          info: colors.teal.lighten1,
          warning: colors.amber.base,
          error: colors.deepOrange.accent4,
          success: colors.green.accent3
        }
      }
    }
  },
  /*
  ** Build configuration
  */
  build: {
    /*
    ** You can extend webpack config here
    */
    extend(config, ctx) {

    }
  },

  server: {
    port: 3000,
    host: "0.0.0.0"
  }

}
