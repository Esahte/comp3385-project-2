import { createRouter, createWebHistory } from 'vue-router';
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import AddCarView from "../views/AddCarView.vue";
import Explore from "../views/Explore.vue";
import RegisterView from "../views/RegisterView.vue";
import LoginView from "../views/LoginView.vue";
import Header from "../components/Header.vue";

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
            path: '/cars/new',
            component: AddCarView,
            meta: { showFooter: true }
        },
        {
            path: '/explore',
            component: Explore,
            meta: { showFooter: true }
        },
        {
            path: '/register',
            component: RegisterView,
            meta: { showFooter: true }
        },
        {
            path: '/login',
            component: LoginView,
            meta: { showFooter: true }
        },
        {
            path: '/logout',
            component: Header,
            meta: { showFooter: true }
        }
    ]
});

export default router;
