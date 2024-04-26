<script setup>
import Header from "./components/Header.vue";
import Footer from "./components/Footer.vue";
</script>

<template>
    <Header />
    <div>
        <RouterView />
    </div>
    <Footer v-if="$route.meta.showFooter" />
</template>

<style scoped>

</style>
