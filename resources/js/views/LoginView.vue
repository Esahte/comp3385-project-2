<script setup>
import { useRouter } from "vue-router";
import { useUserStore } from "../store/userStore.js";

const router = useRouter();

const authorize = async () => {
    const formData = new FormData(document.getElementById('loginForm'));

    const response = await fetch('/api/v1/auth/login', {
        method: 'POST',
        headers: { 'Accept': 'application/json' },
        body: formData
    });

    const data = await response.json();
    console.log(data.message, data.userId);
    localStorage.setItem('token', data.token);
    useUserStore().setUserId(data.userId);
    await router.push('/explore');
}
</script>

<template>
    <div class="container vh-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-6">
                <div class="text-center mb-4">
                    <h2>Login to your account</h2>
                </div>
                <div class="card">
                    <div class="card-body p-5">
                        <form id="loginForm" @submit.prevent="authorize" action="/api/v1/auth/login" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" class="form-control" placeholder="Password">
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
    max-width: 40rem;
}
</style>

