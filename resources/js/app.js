import './bootstrap';
import '../sass/app.scss'
import Router from '@/router'
import store from '@/store'

import { createApp } from 'vue/dist/vue.esm-bundler';
import axios from 'axios'
import VueAxios from 'vue-axios'
axios.defaults.baseURL = '/api/'

// vuetify
import 'vuetify/styles'
import { createVuetify } from 'vuetify'
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'
import { aliases, mdi } from 'vuetify/iconsets/mdi'
import '@mdi/font/css/materialdesignicons.css'
import { VuetifyDateAdapter } from 'vuetify/labs/date/adapters/vuetify'
const vuetify = createVuetify({
    components,
    directives,
    icons: {
        defaultSet: 'mdi',
        aliases,
        sets: {
          mdi,
        },
    },
    adapter: VuetifyDateAdapter,
})



const app = createApp({})
app.use(vuetify)
app.use(Router)
app.use(VueAxios, { $axios: axios})
app.use(store)
app.mount('#app')