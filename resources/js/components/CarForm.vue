<script setup>
const saveCar = async () => {
    const formData = new FormData(document.getElementById('carForm'));

    const response = await fetch('/api/v1/cars', {
        method: 'POST',
        headers: { 'Accept': 'application/json', },
        body: formData
    });

    const data = await response.json();
    console.log(data);
}

</script>

<template>
    <div class="container mt-5">
        <h2>Add New Car</h2>
        <form id="carForm" @submit.prevent="saveCar" action="/api/v1/cars" method="post">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="make">Make</label>
                    <input type="text" class="form-control" id="make" placeholder="Tesla">
                </div>
                <div class="form-group col-md-6">
                    <label for="model">Model</label>
                    <input type="text" class="form-control" id="model" placeholder="Model S">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="colour">Colour</label>
                    <input type="text" class="form-control" id="colour" placeholder="Red">
                </div>
                <div class="form-group col-md-6">
                    <label for="year">Year</label>
                    <input type="text" class="form-control" id="year" placeholder="2018">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="text" class="form-control" id="price" placeholder="62888">
                </div>
                <div class="form-group col-md-6">
                    <label for="carType">Car Type</label>
                    <select id="carType" class="form-control">
                        <option selected>SUV</option>
                        <option>Sedan</option>
                        <option>Coupe</option>
                        <option>Convertible</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="transmission">Transmission</label>
                <select id="transmission" class="form-control">
                    <option selected>Automatic</option>
                    <option>Manual</option>
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="uploadPhoto">Upload Photo</label>
                <input type="file" class="form-control-file" id="uploadPhoto">
            </div>
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</template>

<style scoped>

</style>
