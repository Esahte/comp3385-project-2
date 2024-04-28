<template>
    <div id="app" class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Add New Car</h4>
        </div>
        <div class="card-body">
            <div v-if="success" class="alert alert-success" role="alert">
                {{ message }}
            </div>
            <form @submit.prevent="submitForm" id="car-form" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" id="description" v-model="form.description" >
                </div>
                <div class="mb-3">
                    <label for="make" class="form-label">Make</label>
                    <input type="text" class="form-control" id="make" v-model="form.make" >
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Model</label>
                    <input type="text" class="form-control" id="model" v-model="form.model" >
                </div>
                <div class="mb-3">
                    <label for="colour" class="form-label">Colour</label>
                    <input type="text" class="form-control" id="colour" v-model="form.colour" >
                </div>
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="text" class="form-control" id="year" v-model="form.year" >
                </div>
                <div class="mb-3">
                    <label for="transmission" class="form-label">Transmission</label>
                    <input type="text" class="form-control" id="transmission" v-model="form.transmission" >
                </div>
                <div class="mb-3">
                    <label for="car_type" class="form-label">Car Type</label>
                    <input type="text" class="form-control" id="car_type" v-model="form.car_type" >
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" v-model="form.price" >
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</template>
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
                user_id:67,
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
                'accept': 'application/json'
                // 'authorization': `Bearer ${localStorage.getItem('token')}`
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

<style lang="">
    
</style>
