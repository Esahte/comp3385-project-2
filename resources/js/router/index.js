import { createRouter, createWebHistory } from 'vue-router';
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import AddCarView from '../views/AddCarView.vue';
import LoginView from '../views/LoginView.vue';

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: HomeView
        },
        {
            path: '/about',
            component: AboutView,
            meta: { showFooter: true }
        },
        {
            path: '/cars/create',
            component: AddCarView,
            meta: { showFooter: true }
        },
        {
            path: '/login',
            component: LoginView,
            meta: { showFooter: true }
        },
    ]
});

export default router;
