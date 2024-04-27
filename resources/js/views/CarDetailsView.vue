<script setup>
import {onMounted, ref} from "vue";
import {useUserStore} from "@/store/userStore.js";

const props = defineProps({
    car_id: String
})

const car = ref([]);
const isFavorite = ref(false);

onMounted(async () => {
    try {
        const response = await fetch(`/api/v1/cars/${props.car_id}`, {
            headers: {
                Accept: "application/json",
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        });
        const data = await response.json();
        console.log(data)
        car.value = data.car;
    } catch (e) {
        console.error(e);
    }
});

const toggleFavorite = async () => {
    isFavorite.value = !isFavorite.value;
    try {
        const response = await fetch(`/api/v1/cars/${props.car_id}/favorites`, {
            method: isFavorite.value ? 'POST' : 'DELETE',
            headers: {
                'Accept': 'application/json',
                'Authorization': `Bearer ${localStorage.getItem('token')}`
            },
        });
        const data = await response.json();
        console.log(data);
    } catch (e) {
        console.error(e);
    }
};
</script>

<template>
    <div class="container" style="width: 60%">
        <div class="card mb-3 mx-auto" style="/*max-width: 60rem;*/ height: 30rem"
             :style="{backgroundImage: 'url(/storage/' + car.photo + ')', backgroundSize: 'cover'}">
            <div class="row g-0 details-container">
                <div class="col-md-6 details-content h-100">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <h5 class="card-title">{{ car.year }} {{ car.make }}</h5>
                        <h6 class="text-muted">{{ car.model }}</h6>
                        <p class="card-text">{{ car.description }}</p>
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
                                    <span class="detail-info">{{ car.price }}</span>
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
                            <!-- Place any content here, such as a like button or icon -->
                            <i class="far fa-heart" :class="{ 'fas': isFavorite }" @click="toggleFavorite"></i>
                            <!-- Example: Heart icon -->
                        </div>
                        <button type="button" class="btn btn-success email-owner">Email Owner</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.email-owner {
    margin-top: auto;
    width: 25%;
    padding: 5px 10px; /* Adjust as needed */
    font-size: 0.8rem; /* Adjust as needed */
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

.details-container {
    flex: 1;
    display: flex;
    flex-direction: row-reverse;
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

.text-muted {
    color: #6c757d;
    font-size: 0.8rem;
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

.position-relative {
    position: relative;
}

.position-absolute {
    position: absolute;
}

.bottom-0 {
    bottom: 0;
}

.end-0 {
    right: 0;
}

.p-3 {
    padding: 1rem;
}

.text-danger {
    color: #dc3545; /* Bootstrap danger color, or use your own */
}

.fas.fa-heart {
    font-size: 2rem; /* Adjust the size as needed */
}


</style>
