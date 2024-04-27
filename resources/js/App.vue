<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import { ref } from "vue";

const isLoggedIn = ref(false);

const loggedInHandler = () => {
    isLoggedIn.value = !!localStorage.getItem('token');
}

console.log(isLoggedIn.value);
</script>

<template>
    <Header :isLoggedIn="isLoggedIn" @isLoggedOut="loggedInHandler"/>
    <div class="body">
        <RouterView @isLoggedIn="loggedInHandler"/>
    </div>
    <Footer v-if="$route.meta.showFooter" />
</template>

<style scoped>
.body {
    height: 94.8vh;
    padding-bottom: 100px;
}
</style>
