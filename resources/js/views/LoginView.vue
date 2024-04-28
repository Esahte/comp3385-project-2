<script setup>
import {useRouter} from 'vue-router';
// import { useUserStore } from "../store/userStore.js";

const router = useRouter();
const authorize = async () => {
    const form_data = new FormData(document.getElementById('loginForm'));
    const headers = {'Accept': 'application/json'};
    const response = await fetch('/api/v1/auth/login', {
        method: 'POST',
        headers,
        body: form_data
    });
    if (!response.ok) {
        console.error("ERROR");
        return;
    }
    const data = await response.json();
    localStorage.setItem("token", data.token);
    localStorage.setItem("user_id", data.user_id);
    console.log(data)
    // useUserStore().setUserId(data.user_id);
    await router.push('/explore');
}
</script>
<template>
    <div class="container">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h2>Login to your account</h2>
                </div>
                <div class="card">
                    <div class="card-body p-3">
                        <form id="loginForm" @submit.prevent="authorize" action="/api/v1/auth/login" method="post">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" id="email" class="form-control"
                                       placeholder="Enter email">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" id="password" class="form-control"
                                       placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-success w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.container {
    max-width: 50rem;
    height: 70vh;
}
</style>
