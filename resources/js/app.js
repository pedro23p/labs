import {createApp} from 'vue';

require('./bootstrap');


import App from './App.vue';
import axios from 'axios';
import router from './router';

const app = createApp(App);
app.config.globalProperties.$axios = axios;
app.use(router);
app.mount('#app');

// lembrar de configurar a aplicação com corretamente(importações tb)
// alem do artisan serve, o npm run dev