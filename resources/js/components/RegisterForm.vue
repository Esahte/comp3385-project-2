<script setup>
import { useRouter } from "vue-router";

const router = useRouter();

const register = async () =>
{
    const formData = new FormData(document.getElementById('registerForm'));

    await fetch('/api/v1/auth/register', {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: formData
    });

    await router.push('/login');
}


</script>

<template>
    <div class="container mt-5" style="width: 60%">
        <h3>Register New User</h3>
        <div class="card my-4 shadow-sm">
            <div class="card-body">
                <form id="registerForm" @submit.prevent="register" method="post" action="/api/v1/auth/register">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Fullname</label>
                            <input name="name" type="text" id="name" class="form-control" placeholder="Enter full name">
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input name="email" type="email" id="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password</label>
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Enter password">
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label">Location</label>
                            <input name="location" type="text" id="location" class="form-control"
                                   placeholder="Enter location">
                        </div>
                        <div class="col-md-12">
                            <label for="biography" class="form-label">Biography</label>
                            <textarea name="biography" id="biography" class="form-control"
                                      placeholder="Tell us about yourself"
                                      rows="5"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="photo" class="form-label">Upload Photo</label>
                        <input name="photo" class="form-control" type="file" id="photo">
                    </div>
                    <button type="submit" class="btn btn-primary w-25">Register</button>
                </form>
            </div>
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
