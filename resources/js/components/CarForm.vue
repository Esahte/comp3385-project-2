<script>
export default {
    data() {
        return {
            form: {
                description: '',
                make: '',
                model: '',
                colour: '',
                year: '',
                transmission: '',
                car_type: '',
                price: '',
                photo: null,
                user_id: 67,
            }
        };
    },
    methods: {
        submitForm() {
            let formData = new FormData();

            // Append form data to the FormData object
            for (let key in this.form) {
                formData.append(key, this.form[key]);
            }

            // Append photo file to FormData if it's selected
            let photoInput = document.getElementById('photo');
            if (photoInput.files.length > 0) {
                formData.append('photo', photoInput.files[0]);
            }

            // Log FormData entries using a for...of loop
            for (const entry of formData.entries()) {
                console.log("Entry:", entry);
            }

            fetch("http://localhost/api/v1/cars", {
                method: 'POST',
                body: formData, // Pass FormData object as the body
                headers: {
                    'accept': 'application/json',
                    'authorization': `Bearer ${localStorage.getItem('token')}`
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Display a success message or handle the response
                    this.success = true;
                    this.message = data.message;
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        },
    }

}
</script>

<template>
    <div class="container w-50">
        <h1>
            Add New Car
        </h1>
        <div class="card">
            <div class="card-body">
                <div v-if="success" class="alert alert-success" role="alert">
                    {{ message }}
                </div>
                <form id="carForm" @submit.prevent="submitForm" method="post" action="/api/v1/cars">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="make" class="form-label">Make</label>
                            <input v-model="form.make" name="make" type="text" class="form-control" id="make" placeholder="Tesla">
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label">Model</label>
                            <input v-model="form.model" name="model" type="text" class="form-control" id="model" placeholder="Model S">
                        </div>
                        <div class="col-md-6">
                            <label for="colour" class="form-label">Colour</label>
                            <input v-model="form.colour" name="color" type="text" class="form-control" id="colour" placeholder="Red">
                        </div>
                        <div class="col-md-6">
                            <label for="year" class="form-label">Year</label>
                            <input v-model="form.year" name="year" type="text" class="form-control" id="year" placeholder="2018">
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input v-model="form.price" name="price" type="text" class="form-control" id="price" placeholder="62888">
                        </div>
                        <div class="col-md-6">
                            <label for="carType" class="form-label">Car Type</label>
                            <select v-model="form.car_type" name="car_type" id="carType" class="form-select">
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
                            <select v-model="form.transmission" name="transmission" id="transmission" class="form-select">
                                <option selected>Automatic</option>
                                <option>Manual</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea v-model="form.description" name="description" class="form-control" id="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="uploadPhoto" class="form-label browse-btn">Upload Photo</label>
                        <input @change="form.photo" name="photo" class="form-control" type="file" id="uploadPhoto">
                    </div>
                    <button type="submit" class="btn btn-primary w-25">Save</button>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    padding: 4rem;
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
