<script setup>
import {useUserStore} from "../store/userStore.js";
import {useRouter} from "vue-router";
import {ref} from "vue";

console.log(useUserStore().userId);
const router = useRouter();
const message = ref('');

const saveCar = async () => {
    const form = document.getElementById('carForm');
    const formData = new FormData(form);

    formData.append('user_id', useUserStore().userId);

    const response = await fetch('/api/v1/cars', {
        method: 'POST',
        headers: {'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token')},
        body: formData
    });

    const data = await response.json();
    message.value = data.message; // Set the message from the response

    // Make the message disappear after 3 seconds
    setTimeout(() => {
        message.value = '';
    }, 3000);

    form.reset();
}

</script>

<template>
    <div class="container w-50">
        <h1>
            Add New Car
        </h1>
        <div v-if="message" class="alert alert-success">
            {{ message }}
        </div>
        <div class="card">
            <div class="card-body">
                <form id="carForm" @submit.prevent="saveCar" method="post" action="/api/v1/cars">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="make" class="form-label">Make</label>
                            <input name="make" type="text" class="form-control" id="make" placeholder="Tesla">
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label">Model</label>
                            <input name="model" type="text" class="form-control" id="model" placeholder="Model S">
                        </div>
                        <div class="col-md-6">
                            <label for="colour" class="form-label">Colour</label>
                            <input name="color" type="text" class="form-control" id="colour" placeholder="Red">
                        </div>
                        <div class="col-md-6">
                            <label for="year" class="form-label">Year</label>
                            <input name="year" type="text" class="form-control" id="year" placeholder="2018">
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input name="price" type="text" class="form-control" id="price" placeholder="62888">
                        </div>
                        <div class="col-md-6">
                            <label for="carType" class="form-label">Car Type</label>
                            <select name="car_type" id="carType" class="form-select">
                                <option selected>SUV</option>
                                <option>Sedan</option>
                                <option>Coupe</option>
                                <option>Convertible</option>
                                <option>Sports Car</option>
                                <option>Hatchback</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="transmission" class="form-label">Transmission</label>
                            <select name="transmission" id="transmission" class="form-select">
                                <option selected>Automatic</option>
                                <option>Manual</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="uploadPhoto" class="form-label browse-btn">Upload Photo</label>
                        <input name="photo" class="form-control" type="file" id="uploadPhoto">
                    </div>
                    <button type="submit" class="btn btn-primary w-25">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    padding-bottom: 4rem;
}

.card {
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.btn-primary {
    background-color: #198754;
    border: none;
}

.btn-primary:hover {
    background-color: #157347;
}

.form-label {
    margin-bottom: 0.5rem;
}

.form-control, .form-select {
    margin-bottom: 1rem;
}

.form-control::file-selector-button {
    margin-right: 0.5rem;
}

.browse-btn {
    font-size: 0.875rem;
}

.card-body {
    padding: 2rem;
}
</style>
