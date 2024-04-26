<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
import {onMounted, onUpdated, ref} from "vue";

const loggedInHandler = () => {
    console.log("User is logged in")
}
const isLoggedIn = ref(false);

console.log(isLoggedIn.value);

onMounted(() => {
    isAuthenticated();
    console.log(isLoggedIn.value);
});


onUpdated(() => {
    isAuthenticated();
    console.log(isLoggedIn.value);
});


function isAuthenticated() {
    isLoggedIn.value = !!localStorage.getItem('token');
}
</script>

<template>
    <Header :isLoggedIn="isLoggedIn" @isLoggedOut="loggedInHandler"/>
    <div>
        <RouterView @isLoggedIn="loggedInHandler"/>
    </div>
    <Footer v-if="$route.meta.showFooter" />
</template>

<style scoped>

</style>
