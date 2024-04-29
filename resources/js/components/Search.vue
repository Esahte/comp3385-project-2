<script setup>
import {ref} from "vue";

let model = ref("");
let make = ref("");
let suggestions = ref([]);
const emit = defineEmits(['search-complete']);

let makeSuggestions = ref([]);
let modelSuggestions = ref([]);

const searchMakesAndModels = async (query, type) => {
    const response = await fetch(`/api/v1/cars/search?query=${query}`, {
        headers: {'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token')}
    });

    const data = await response.json();

    if (type === 'make') {
        makeSuggestions.value = data.suggestions;
    } else if (type === 'model') {
        modelSuggestions.value = data.suggestions;
    }
}

const search = async () => {
    const response = await fetch(`/api/v1/search?make=${make.value}&model=${model.value}`, {
        headers: {'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token')}
    });

    const data = await response.json();
    emit('search-complete', data.cars);// Now you can use the data in your component

    make.value = '';
    model.value = '';
}

const onInput = (event, type) => {
    searchMakesAndModels(event.target.value, type);
}

const onBlur = (type) => {
    setTimeout(() => {
        if (type === 'make') {
            makeSuggestions.value = [];
        } else if (type === 'model') {
            modelSuggestions.value = [];
        }
    }, 200); // Delay of 200ms
}
</script>

<template>
    <div class="my-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <form @submit.prevent="search">
                    <div class="row g-3 align-items-end">
                        <div class="col">
                            <div style="position: relative;">
                                <label for="make" class="form-label">Make</label>
                                <input id="make" type="text" class="form-control" placeholder="Make" v-model="make"
                                       @input="event => onInput(event, 'make')" @blur="() => onBlur('make')">
                                <ul class="list-group" v-show="makeSuggestions.length">
                                    <li class="list-group-item" v-for="suggestion in makeSuggestions" :key="suggestion"
                                        @click="make = suggestion">{{ suggestion }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col">
                            <div style="position: relative;">
                                <label for="model" class="form-label">Model</label>
                                <input id="model" type="text" class="form-control" placeholder="Model" v-model="model"
                                       @input="event => onInput(event, 'model')" @blur="() => onBlur('model')">
                                <ul class="list-group" v-show="modelSuggestions.length">
                                    <li class="list-group-item" v-for="suggestion in modelSuggestions" :key="suggestion"
                                        @click="model = suggestion">{{ suggestion }}
                                    </li>
                                </ul>
                            </div>
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
.card-body {
    margin: 1rem 2rem 2rem 2rem; /* Adjust this value to your liking */
}

.list-group {
    position: absolute;
    width: 100%;
    z-index: 1;
}
</style>
