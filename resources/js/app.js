import './bootstrap';

window.__VUE_PROD_HYDRATION_MISMATCH_DETAILS__ = false;

import { createApp } from 'vue'
import App from './App.vue'

const app = createApp({})
app.component('App', App)

app.mount('#app')