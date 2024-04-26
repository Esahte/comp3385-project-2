<script setup>
import { onMounted, onUnmounted } from 'vue';

onMounted(() => {
    document.body.style.background = "url('https://picsum.photos/1228/768') no-repeat center center";
    document.body.style.backgroundSize = "cover";
});

onUnmounted(() => {
    document.body.style.background = "";
});
</script>

<template>
    <div class="welcome-container d-flex align-items-center justify-content-center">
        <section class="hero-section">
            <div class="d-flex align-items-center justify-content-center">
                <div class="container d-flex flex-column justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-md-8 text-left">
                            <h1 class="display-3 fw-bold">Buy and Sell Cars Online</h1>
                            <p class="lead my-4">United Auto Sales provides the fastest, easiest and most user friendly way
                                to buy or sell cars online. Find a Great Price on the Vehicle You Want</p>
                            <div class="register-login-buttons">
                                <a href="/register" class="btn btn-primary btn-lg me-2">Register</a>
                                <a href="/login" class="btn btn-success btn-lg">Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
.welcome-container {
    flex: 1;
    background-color: white;
    width: 50%;
    height: 94.5vh;
}

.hero-section {
    padding: 100px 0;
}

.container {
    width: 90%;
    height: 100%;
}

.register-login-buttons {
    margin-top: 20px;
}

.btn {
    width: 9rem;
}
</style>
