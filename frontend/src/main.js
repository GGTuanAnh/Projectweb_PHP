import { createApp } from 'vue';
import { createPinia } from 'pinia';
import router from './router';
import App from './App.vue';
import axios from 'axios';

import './style.css';
import './assets/tailwind.css';

// Restore token if exists
const token = localStorage.getItem('token');
if (token) {
  axios.defaults.headers.common.Authorization = `Bearer ${token}`;
}

const app = createApp(App);
app.use(createPinia());
app.use(router);
app.mount('#app');
