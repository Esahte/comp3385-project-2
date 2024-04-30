<template>
    <div class="container w-50 mt-5">
        <div v-if="car" class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                    <img :src="'/storage/car_photos/' + car.photo" class="img-fluid rounded-start" :alt="car.make">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <div class="d-flex flex-column mb-3">
                            <div>
                                <p class="card-title fs-1 fw-bold mb-0">{{ car.year }} {{ car.make }}</p>
                                <p class="card-text fs-2 fw-bold text-body-secondary">{{ car.model }}</p>
                                <p class="card-text fw-medium">{{ car.description }}</p>
                                <div class="row">
                                    <div class="col">
                                        <p class="card-text fw-medium">Color {{ car.colour }}</p>
                                    </div>
                                    <div class="col">
                                        <p class="card-text fw-medium">Body Type {{ car.car_type }}</p>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col">
                                        <p class="card-text fw-medium">Price {{ car.price }}</p>
                                    </div>
                                    <div class="col">
                                        <p class="card-text fw-medium">Transmission {{ car.transmission }}</p>
                                    </div>
                                </div>

                            </div>
                            <div>
                                <button class="btn btn-primary">Button</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from 'vue';
import {useRoute} from 'vue-router';

const car = ref(null);
const route = useRoute();

onMounted(async () => {
    const carId = route.params.id;
    try {
        const response = await fetch("http://localhost/api/v1/cars/" + carId, {
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
        car.value = data.car;

        // car.value = data.car;
        console.log("This is the car:", car.value);
    } catch (error) {
        console.error(error.message);
    }
});

</script>

<style>
/* Add your custom styles here */
</style>
