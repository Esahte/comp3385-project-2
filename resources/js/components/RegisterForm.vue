<template>
    <div>
        <h2 class="mb-5">Register New User</h2>
        <form id="registerForm" @submit.prevent="saveUser" action="/api/v1/auth/register" method="post">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" class="form-control"/>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" class="form-control"/>
            </div>
            <div class="form-group mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" name="location" class="form-control"/>
            </div>
            <div class="form-group mb-3">
                <label for="biography" class="form-label">Biography</label>
                <textarea class="form-control" id="biography" rows="3" name="biography"></textarea>
            </div>
            <div class="form-group mb-3">
                <label for="photo" class="form-label">Upload Photo</label>
                <input type="file" class="form-control" id="photo" name="photo" required>
            </div>
            <button type="submit" class="btn" style="background-color: green; color: white;">Register</button>
        </form>
    </div>
</template>

<script setup>
import {useRouter} from 'vue-router';

const router = useRouter();
const saveUser = async () => {
    const form_data = new FormData(document.getElementById('registerForm'));
    const headers = {'Accept': 'application/json', 'Authorization': 'Bearer ' + localStorage.getItem('token')};
    const response = await fetch('/api/v1/auth/register', {
        method: 'POST',
        headers,
        body: form_data
    });
    const data = await response.json();
    console.log(data);
    await router.push('/login');
}
</script>
