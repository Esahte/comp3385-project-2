<template>
    <div class="container py-5">
        <div v-if="user" class="user-info">
            <img :src="user.avatar" alt="User Avatar" class="avatar">
            <h1>{{ user.name }}</h1>
            <p>{{ user.bio }}</p>
            <p><strong>Email:</strong> {{ user.email }}</p>
            <p><strong>Location:</strong> {{ user.location }}</p>
            <p><strong>Joined:</strong> {{ user.joined }}</p>
        </div>
        <h2 class="my-4">Cars Favourited</h2>
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" v-for="car in favouriteCars" :key="car.id">
                <div class="card">
                    <img :src="'/storage/' + car.photo" class="card-img-top" alt="Car Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ car.year }} {{ car.make }} - {{ car.model }}</h5>
                        <p class="card-text">{{ car.model }}</p>
                        <span class="price-tag">
              <i class="material-symbols-rounded">sell</i>
              ${{ formatPrice(car.price) }}
            </span>
                        <button @click="checkFavourite(car.id)" class="btn btn-info">Check Favourite</button>
                        <button @click="toggleFavourite(car.id)" class="btn btn-primary">
                            {{ car.isFavourite ? 'Remove from Favourites' : 'Add to Favourites' }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useUserStore} from "../store/userStore.js";
import { ref, onMounted } from 'vue';

const user = ref(null);
const favouriteCars = ref([]);

onMounted(async () => {
    await fetchFavouriteCars();
});

async function fetchFavouriteCars() {
    try {
        const response = await fetch(`/api/user/${useUserStore().userId}/favourites`, { headers: { 'Authorization': 'Bearer ' + localStorage.getItem('token') } });
        if (response.ok) {
            const data = await response.json();
            favouriteCars.value = data.getcar;
        }
    } catch (error) {
        console.error('Error fetching favourite cars:', error);
    }
}


function formatPrice(price) {
    return price.toLocaleString();
}
</script>

<style scoped>
.avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
}
.price-tag {
    display: flex;
    align-items: center;
    gap: 8px;
    background-color: #28a745;
    color: white;
    padding: 5px 10px;
    border-radius: 10px;
}
.card {
    height: 400px;
}
.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}
</style>
