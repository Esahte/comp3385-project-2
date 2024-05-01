import {createRouter, createWebHistory} from 'vue-router';
import HomeView from "../views/HomeView.vue";
import AboutView from "../views/AboutView.vue";
import AddCarView from '../views/AddCarView.vue';
import Explore from "../views/Explore.vue";
import LoginView from '../views/LoginView.vue';
import AddNewUser from '../views/AddNewUser.vue';
import CarDetailsView from '../views/CarDetailsView.vue';
import FavouriteView from "../views/FavouriteView.vue";

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
            meta: {showFooter: true}
        },
        {
            path: '/cars/new',
            component: AddCarView,
            meta: {showFooter: true}
        },
        {
            path: '/explore',
            component: Explore,
            meta: {showFooter: true}
        },
        {
            path: '/login',
            component: LoginView,
            meta: {showFooter: true}
        },
        {
            path: '/login',
            component: LoginView,
            meta: {showFooter: true}
        },
        {
            path: '/register',
            component: AddNewUser,

        },
        {
            path: '/cars/:id',
            name: 'CarDetailsView',
            component: CarDetailsView,
            meta: {showFooter: true}
        },
        {
            path: '/users/:user_id',
            name:'FavouriteView',
            component: FavouriteView,
            meta: {showFooter: true} // Assuming you want this route protected
        }
    ]
});

export default router;
