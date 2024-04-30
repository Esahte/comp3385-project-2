<script setup>
import {onMounted, ref} from "vue";
import Search from "../components/Search.vue";
import {formatPrice, viewCarDetails} from "../utils.js";
import {useRouter} from 'vue-router';

const router = useRouter();

const cars = ref([]);

onMounted(async () => {
    try {
        const response = await fetch("/api/v1/cars", {
            headers: {
                Accept: "application/json",
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        });
        const data = await response.json();
        cars.value = data.data;
    } catch (error) {
        console.error(error);
    }
});

const handleSearchComplete = (data) => {
    cars.value = data;
};
</script>

<template>
    <div class="container py-5" style="width: 60%">
        <h1 class="mb-4">Explore</h1>

        <Search @search-complete="handleSearchComplete"/>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" v-for="car in cars" :key="car.id">
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
                        <!--                        <RouterLink :to="{ name: 'CarDetailsView', params: { car_id: car.id } }"
                                                            class="btn btn-primary stretched-link mt-auto">View more details
                                                </RouterLink>-->
                        <button @click="viewCarDetails(car.id)" type="button"
                                class="btn btn-primary stretched-link mt-auto">View more details
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
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
