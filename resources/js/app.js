import './bootstrap';
import {createApp} from 'vue';
import { createPinia } from 'pinia'
import App from './src/components/App.vue';
import router from './src/router/router.js';
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/aura-light-green/theme.css'
import '@/assets/css/style.scss'
import Vue3TouchEvents from "vue3-touch-events";
import ConfirmationService from 'primevue/confirmationservice';
import ToastService from 'primevue/toastservice';


createApp(App)
    .use(PrimeVue)
    .use(createPinia())
    .use(router)
    .use(Vue3TouchEvents)
    .use(ConfirmationService)
    .use(ToastService)
    .mount('#app')
