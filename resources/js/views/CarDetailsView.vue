<script setup>
import {onMounted, ref} from "vue";

const props = defineProps({
    car_id: String
})

const car = ref([]);

onMounted(async () => {
    try {
        const response = await fetch(`/api/v1/cars/${props.car_id}`, {
            headers: {
                Accept: "application/json",
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        });
        const data = await response.json();
        console.log(data)
        car.value = data.car;
    } catch (e) {
        console.error(e);
    }
});
</script>

<template>
    <div class="container">
        <div class="card mb-3 mx-auto" style="max-width: 50rem;">
            <div class="row g-0 details-container">
                <div class="col-md-6 details-image">
                    <img :src="'/storage/' + car.photo" class="img-fluid rounded-start" alt="Car">
                </div>
                <div class="col-md-6 details-content">
                    <div class="card-body d-flex flex-column justify-content-between h-100">
                        <h5 class="card-title">{{ car.year }} {{ car.make }}</h5>
                        <h6 class="text-muted">{{ car.model }}</h6>
                        <p class="card-text">{{ car.description }}</p>
                        <div class="details-grid">
                            <div class="detail">
                                <span class="detail-title">Color</span>
                                <span class="detail-info">{{ car.color }}</span>
                            </div>
                            <div class="detail">
                                <span class="detail-title">Body Type</span>
                                <span class="detail-info">{{ car.car_type }}</span>
                            </div>
                            <div class="detail">
                                <span class="detail-title">Price</span>
                                <span class="detail-info">{{ car.price }}</span>
                            </div>
                            <div class="detail">
                                <span class="detail-title">Transmission</span>
                                <span class="detail-info">{{ car.transmission }}</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success email-owner">Email Owner</button>
                        <i class="far fa-heart"></i> <!-- Font Awesome Heart Icon -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.details-image img {
    object-fit: cover; /* Resize the image to cover the container */
    width: 100%; /* Make the image take up the full width of the container */
    height: 100%; /* Make the image take up the full height of the container */
}

.details-container {
    display: flex;
    flex-direction: row-reverse;
}

.details-image {
    order: 2;
}

.details-content {
    order: 1;
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

.email-owner {
    width: 100%;
}

.fa-heart {
    color: #dc3545;
    position: absolute;
    bottom: 1rem;
    right: 1rem;
    font-size: 1.5rem;
}
</style>
