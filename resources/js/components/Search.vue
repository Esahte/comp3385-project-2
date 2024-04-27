<script setup>
import {ref} from "vue";

let model = ref("");
let make = ref("");
let suggestions = ref([]);
const emit = defineEmits(['search-complete']);

const searchMakesAndModels = async (query) => {
    const response = await fetch(`/api/v1/cars/search?query=${query}`, {
        headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token') }
    });

    const data = await response.json();

    suggestions.value = data.suggestions;
}

const search = async () => {
    const response = await fetch(`/api/v1/search?make=${make.value}&model=${model.value}`, {
        headers: { 'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token') }
    });

    const data = await response.json();

    // Now you can use the data in your component
    console.log(data);
    emit('search-complete', data.cars);
}

const onInput = (event) => {
    searchMakesAndModels(event.target.value);
}
</script>

<template>
    <div class="my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form @submit.prevent="search">
                    <div class="row g-3 align-items-end">
                        <div class="col">
                            <label for="make" class="form-label">Make</label>
                            <input id="make" type="text" class="form-control" placeholder="Make" v-model="make" @input="onInput">
                            <ul class="list-group" v-show="suggestions.length">
                                <li class="list-group-item" v-for="suggestion in suggestions" :key="suggestion">{{ suggestion }}</li>
                            </ul>
                        </div>
                        <div class="col">
                            <label for="model" class="form-label">Model</label>
                            <input id="model" type="text" class="form-control" placeholder="Model" v-model="model" @input="onInput">
                            <ul class="list-group" v-show="suggestions.length">
                                <li class="list-group-item" v-for="suggestion in suggestions" :key="suggestion">{{ suggestion }}</li>
                            </ul>
                        </div>
                        <div class="col-auto button">
                            <button class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
/*.button {
    width: 15%;
}*/

.card-body {
    margin: 1rem 2rem 2rem 2rem; /* Adjust this value to your liking */
}
</style>
