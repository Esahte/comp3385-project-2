<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const register = async () => {
    const formData = new FormData(document.getElementById('registerForm'));

    const response = await fetch('/api/v1/auth/register', {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: formData
    });

    const data = await response.json();
    console.log(data.message);
    await router.push('/');
}

</script>

<template>
    <h3>Register New User</h3>
    <div class="card my-4 shadow-sm">
        <div class="card-body">
            <form id="registerForm" @submit.prevent="register" method="post" action="/api/v1/auth/register">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" class="form-control" placeholder="Enter username">
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" placeholder="Enter password">
                    </div>
                    <div class="col-md-6">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input type="text" id="fullname" class="form-control" placeholder="Enter full name">
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" id="location" class="form-control" placeholder="Enter location">
                    </div>
                    <div class="col-md-12">
                        <label for="biography" class="form-label">Biography</label>
                        <textarea id="biography" class="form-control" placeholder="Tell us about yourself"
                                  rows="3"></textarea>
                    </div>
                </div>
                <div class="mb-3 mt-3">
                    <label for="uploadPhoto" class="form-label">Upload Photo</label>
                    <input class="form-control" type="file" id="uploadPhoto">
                </div>
                <button type="submit" class="btn btn-primary w-25">Register</button>
            </form>
        </div>
    </div>
</template>

<style scoped>
.card {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 2rem;
}

.btn-primary {
    background-color: #198754;
    border: none;
}

.btn-primary:hover {
    background-color: #157347;
}
</style>
