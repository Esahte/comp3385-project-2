<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
    <Header />
    <div class="container my-5">
        <RouterView />
    </div>
    <Footer />
</template>

<style scoped>
body {
    background-color: #f5f5f5;
}

.container {
    max-width: 800px;
    padding-top: 20px;
}
</style>
