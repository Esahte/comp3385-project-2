<script setup>
import bgImage from '../../images/black-sport-car-back-vire-motor-gas-pipes-blank-space-registration-number.jpg';

// export let bgImage;
</script>

<template>
    <div class="welcome-container d-flex align-items-center justify-content-center">
        <div class="content-section">
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
        <div class="image-section">
            <img :src="bgImage" alt="Background Image">
        </div>
    </div>
</template>

<style scoped>
.welcome-container {
    display: flex;
    flex: 1;
    background-color: white;
    height: 94.8vh;
}

.content-section, .image-section {
    flex: 1;
    height: 100%;
}

.content-section {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.image-section img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
