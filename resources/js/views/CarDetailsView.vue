<script setup>
import {onMounted, ref} from 'vue';
import {useRoute} from 'vue-router';
import {formatPrice} from '../utils.js';

const car = ref(null);
const route = useRoute();
const isFavorite = ref(false);
const carId = route.params.id;

onMounted(async () => {

    try {
        const response = await fetch("/api/v1/cars/" + carId, {
            headers: {
                Accept: 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        });
        if (!response.ok) {
            console.log('Failed to fetch car details')
            return;
        }
        const data = await response.json();
        car.value = data.data;
        await checkFavourite();

        // car.value = data.car;
        console.log("This is the car:", data.data);
    } catch (error) {
        console.error(error.message);
    }
});

const toggleFavorite = async () => {
    isFavorite.value = !isFavorite.value;
    // Add logic to update the favorite status in the database
    const method = !isFavorite.value ? 'DELETE' : 'POST';
    try {
        await fetch(`/api/v1/cars/${carId}/favourite`, {
            method: method,
            headers: {
                Accept: 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        });
    } catch (error) {
        console.error('Error toggling favourite status:', error);
    }
}


async function checkFavourite() {
    try {
        const response = await fetch(`/api/cars/${carId}/check-favourite`, {
            headers: {
                Accept: 'application/json',
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        });
        if (response.ok) {
            const success = await response.json();
            if (success.success){
                isFavorite.value=true;
            }
        }

    } catch (error) {
        console.error('Error checking favourite status:', error);
    }
}

</script>

<template>
    <div v-if="car" class="container" style="width: 60%">
        <div class="card mb-3 mx-auto" style="/*max-width: 60rem;*/ height: 30rem">
            <div class="row g-0 details-container">
                <div class="col-md-6">
                    <img :src="'/storage/' + car.photo" alt="Car Image" class="img-fluid">
                </div>
                <div class="col-md-6 details-content h-100">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <p class="card-title fs-1 fw-bold mb-0">{{ car.year }} {{ car.make }}</p>
                        <p class="card-text fs-2 fw-bold text-body-secondary">{{ car.model }}</p>
                        <p class="card-text fw-medium">{{ car.description }}</p>
                        <div class="details-grid">
                            <div class="row gx-2 detail mb-3">
                                <div class="col text-start">
                                    <span class="detail-title text-muted">Color:</span>
                                </div>
                                <div class="col text-start">
                                    <span class="detail-info">{{ car.color }}</span>
                                </div>
                            </div>
                            <div class="row gx-2 detail mb-3">
                                <div class="col text-start">
                                    <span class="detail-title text-muted">Body Type:</span>
                                </div>
                                <div class="col text-start">
                                    <span class="detail-info">{{ car.car_type }}</span>
                                </div>
                            </div>
                            <div class="row gx-2 detail mb-3">
                                <div class="col text-start">
                                    <span class="detail-title text-muted">Price:</span>
                                </div>
                                <div class="col text-start">
                                    <span class="detail-info">${{ formatPrice(car.price) }}</span>
                                </div>
                            </div>
                            <div class="row gx-2 detail mb-3">
                                <div class="col text-start">
                                    <span class="detail-title text-muted">Transmission:</span>
                                </div>
                                <div class="col text-start">
                                    <span class="detail-info">{{ car.transmission }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="like-section">
                            <i class="far fa-heart" :class="{ 'fas': isFavorite }" @click="toggleFavorite"></i>
                        </div>
                        <button type="button" class="btn btn-success email-owner">Email Owner</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.card {
    overflow: hidden; /* Add this line */
}

.img-fluid {
    max-width: 100%;
    height: 100%;
    object-fit: cover;
}

.details-container {
    height: 100%;
}

.details-container > div {
    height: 100%;
}

.email-owner {
    margin-top: auto;
    width: 25%;
    padding: 8px 10px; /* Adjust as needed */
}

.container {
    margin-top: 3rem;
}

.details-image img {
    object-fit: cover; /* Resize the image to cover the container */
    width: 100%; /* Make the image take up the full width of the container */
    height: 100%; /* Make the image take up the full height of the container */
}

.card.mb-3 {
    display: flex;
    flex-direction: column;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.details-content {
    background-color: white;
    order: 2;
}

.card-body {
    font-size: 0.9rem;
}

.card-title, .detail-info {
    font-weight: bold;
}

.details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 0.5rem 1.5rem;
    margin-bottom: 1rem;
}

.detail {
    display: flex;
    justify-content: space-between;
}

.fa-heart {
    color: #dc3545;
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    font-size: 1.5rem;
    width: 2.5rem; /* Adjust as needed */
    height: 2.5rem; /* Adjust as needed */
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background-color: #fff;
    box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);
}

.fas.fa-heart {
    font-size: 2rem; /* Adjust the size as needed */
}
</style>


