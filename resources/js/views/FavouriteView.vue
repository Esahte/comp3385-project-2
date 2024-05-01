<script setup>
import {useUserStore} from "../store/userStore.js";
import {onMounted, ref} from 'vue';
import UserCard from "../components/UserCard.vue";
import {useRouter} from 'vue-router';
import {formatPrice} from '../utils.js';

const router = useRouter();
const user = ref(null);
const favouriteCars = ref([]);

onMounted(async () => {
    await fetchFavouriteCars();
});

async function fetchFavouriteCars() {
    try {
        const response = await fetch(`/api/v1/user/${useUserStore().userId}/favourites`, {
            headers: {
                Accept: 'application/json',
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        });
        if (response.ok) {
            const data = await response.json();
            favouriteCars.value = data.getCar;
        }
    } catch (error) {
        console.error('Error fetching favourite cars:', error);
    }
}

const viewCarDetail = (id) => {
    // Programmatically navigate to CarDetails route with the id
    router.push(`/cars/${id}`);
}
</script>

<template>
    <div v-if="favouriteCars" class="container py-5" style="width: 60%">
        <UserCard :user_id="useUserStore().userId" />
        <!-- Cars Favorites Section -->
        <h3>Cars Favorites</h3>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" v-for="car in favouriteCars" :key="car.id">
                <div class="card">
                    <img :src="'/storage/' + car.photo" class="card-img-top" :alt="car.model">
                    <div class="card-body d-flex flex-column justify-content-start">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column flex-lg-row">
                                <h5 class="card-title text-muted mb-0 me-1">{{ car.year }}</h5>
                                <h5 class="card-title mb-0 ml-lg-2">{{ car.make }}</h5>
                            </div>
                            <span class="price-tag">
                <i class="material-symbols-rounded">sell</i> <!-- Add this line -->
                ${{ formatPrice(car.price) }}
              </span>
                        </div>
                        <p class="card-text text-muted align-self-start mt-1">{{ car.model }}</p>
                        <button @click="viewCarDetail(car.id)" type="button"
                                class="btn btn-primary stretched-link mt-auto">View more details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.user-profile h2, .user-profile p {
    margin-bottom: 0;
}

.user-profile .user-details p {
    margin-bottom: 0.5rem;
}

.material-symbols-rounded {
    font-variant: normal;
    font-size: inherit; /* Size it as you like */
}

.price-tag {
    display: flex; /* Use Flexbox */
    align-items: center; /* Center items vertically */
    gap: 8px; /* Space between items */
    background-color: #28a745;
    color: white;
    padding: 5px 5px; /* Increase padding */
    border-radius: 10px; /* Increase border radius */
}

.card-title.text-muted {
    font-size: 1.05rem; /* Decrease font size */
}

.card-title {
    font-size: 1.05rem; /* Decrease font size */
}

.card {
    height: 400px; /* Adjust this value to your liking */
}

.card-body {
    position: relative;
}

.stretched-link::after {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    content: "";
}
</style>
