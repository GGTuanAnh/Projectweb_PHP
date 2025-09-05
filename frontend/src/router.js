import { createRouter, createWebHistory } from 'vue-router';
import Home from './views/Home.vue';
import Menu from './views/Menu.vue';
import ProductDetail from './views/ProductDetail.vue';
import Login from './views/Login.vue';

const routes = [
  { path: '/', name: 'home', component: Home },
  { path: '/menu', name: 'menu', component: Menu },
  { path: '/products/:id', name: 'product-detail', component: ProductDetail, props: true },
  { path: '/login', name: 'login', component: Login },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach((to, from, next) => {
  // simple auth redirect example placeholder for future protected routes
  if (to.meta.requiresAuth) {
    const token = localStorage.getItem('token');
    if (!token) return next({ name: 'login' });
  }
  next();
});

export default router;
