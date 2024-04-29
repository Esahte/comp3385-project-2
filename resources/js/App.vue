<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import {ref} from "vue";

const isLoggedIn = ref(false);

const loggedInHandler = () => {
    isLoggedIn.value = !!localStorage.getItem('token');
}

const flashMessage = ref('');
const displayFlashMessage = (message) => {
    flashMessage.value = message;
    setTimeout(() => {
        flashMessage.value = '';
    }, 3000);
}
</script>

<template>
    <Header :isLoggedIn="isLoggedIn" @isLoggedOut="loggedInHandler"/>
    <div class="body">
        <RouterView @isLoggedIn="loggedInHandler" @user-created="displayFlashMessage"/>
        <div v-if="flashMessage" class="alert alert-success" role="alert">
            {{ flashMessage }}
        </div>
    </div>
    <Footer v-if="$route.meta.showFooter"/>
</template>

<style scoped>
.body {
    height: 94.8vh;
    padding-bottom: 100px;
}
</style>
