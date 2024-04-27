<script setup>
import UserInfoCard from "../components/UserInfoCard.vue";
import { ref, onMounted, defineProps } from "vue";
import { formatPrice } from "../utils.js";

const props = defineProps({
    user_id: String
})

const cars = ref([]);

onMounted(async () => {
    try {
        const response = await fetch(`/api/v1/users/${props.user_id}/favourites`, {
            headers: {
                Accept: "application/json",
                'Authorization': 'Bearer ' + localStorage.getItem('token')
            },
        });
        const data = await response.json();
        console.log(data);
        cars.value = data.favourites;
    } catch (error) {
        console.error(error);
    }
});
</script>

<template>
    <div class="container py-4" style="width: 60%">
        <UserInfoCard :userId="user_id" />
        <!-- Cars Favorites Section -->
        <h3>Cars Favorites</h3>
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
                        <RouterLink :to="{ name: 'CarDetailsView', params: { car_id: car.id } }"
                                    class="btn btn-primary stretched-link mt-auto">View more details
                        </RouterLink>
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

.price-tag {
    display: inline-flex;
    align-items: center;
    background-color: #4caf50;
    color: white;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
}

.material-symbols-rounded {
    font-variant: normal;
    font-size: inherit; /* Size it as you like */
}

/* Further styling as needed... */
</style>
