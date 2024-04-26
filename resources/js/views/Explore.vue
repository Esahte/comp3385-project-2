<script setup>
import {onMounted, ref} from "vue";
import Search from "../components/Search.vue";

const cars = ref([]);

onMounted(async () => {
    try {
        const response = await fetch("/api/v1/cars", {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        });
        const data = await response.json();
        console.log(data);
        cars.value = data.cars;
    } catch (error) {
        console.error(error);
    }
});

const handleSearchComplete = (data) => {
    cars.value = data;
};
</script>

<template>
    <div class="container mt-5" style="width: 60%">
        <h1 class="mb-4">Explore</h1>

        <Search @search-completed="handleSearchComplete"/>

        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4" v-for="car in cars" :key="car.id">
                <div class="card h-100">
                    <img :src="'/storage/images' + car.photo" class="card-img-top" :alt="car.model">
                    <div class="card-body">
                        <span class="price-tag">${{ car.price }}</span>
                        <h5 class="card-title">{{ car.year }} {{ car.make }} {{ car.model }}</h5>
                        <p class="card-text">
                            <i class="bi bi-check-lg badge-check"></i> {{ car.description }}
                        </p>
                        <a href="#" class="btn btn-primary">View more details</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
