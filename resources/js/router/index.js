import { createRouter, createWebHistory } from 'vue-router';
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import AddCarView from "../views/AddCarView.vue";
import Explore from "../views/Explore.vue";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            component: HomeView
        },
        {
            path: '/about',
            component: AboutView
        },
        {
            path: '/cars/new',
            component: AddCarView
        },
        {
            path: '/explore',
            component: Explore
        }
    ]
});

export default router;
