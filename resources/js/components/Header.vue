<script setup>
import {useUserStore} from "../store/userStore.js";
import {useRouter} from "vue-router";

const router = useRouter();


defineProps(['isLoggedIn']);

const emit = defineEmits(['isLoggedOut']);

const logout = async () =>
    {
        try {
            await fetch('/api/v1/auth/logout', {
                method: 'POST',
                headers: {'Authorization': 'Bearer ' + localStorage.getItem('token'), 'Accept': 'application/json'}
            });

            localStorage.removeItem('token');
            useUserStore().setUserId(null);

            emit('isLoggedOut', true);
            await router.push('/');
        } catch (error) {
            console.error(error);
        }
    }
;
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid mx-3">
            <a class="navbar-brand" href="/">
                <div class="brand-container">
                    <i class="material-icons">
                        directions_car
                    </i>
                    United Auto Sales
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- Items shown regardless of login state -->
                    <li class="nav-item" v-if="isLoggedIn">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/cars/new'}" to="/cars/new">Add
                            Car
                        </RouterLink>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/explore'}" to="/explore">
                            Explore
                        </RouterLink>
                    </li>
                    <li class="nav-item" v-if="isLoggedIn">
                        <RouterLink class="nav-link" :class="{ active: $route.path === '/users/:user_id'}" :to="{ name: 'FavouriteView', params: { user_id: useUserStore().userId } }">
                            My Profile
                        </RouterLink>
                    </li>
                </ul>
                <!-- Right aligned items, shown based on login state -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item" v-if="!isLoggedIn">
                        <RouterLink class="nav-link" to="/register">Register</RouterLink>
                    </li>
                    <li class="nav-item" v-if="!isLoggedIn">
                        <RouterLink class="nav-link" to="/login">Login</RouterLink>
                    </li>
                    <li class="nav-item" v-else>
                        <button class="nav-link btn btn-link" @click="logout">Logout</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<style scoped>
.navbar-brand {
    margin-right: 8rem; /* Adjust this value to your liking */
}

.brand-container {
    display: flex;
    align-items: center;
}

.material-icons {
    margin-right: 1rem;
}
</style>
