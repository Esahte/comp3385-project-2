<script setup>
import { useRouter } from 'vue-router';
const router=useRouter();
const authorize = async () => {
  const form_data = new FormData(document.getElementById('loginForm'));
  const headers = { 'Accept': 'application/json'};
  const response = await fetch('/api/v1/auth/login', {
    method: 'POST',
    headers,
    body: form_data
  });
  if (!response.ok){
    console.error("ERROR");
    return;
  }
  const data = await response.json();
  localStorage.setItem("token",data.token);
  console.log(data);
  await router.push('/explore');
}
</script>
<template>
    <div class="container">
        <h2 class="mb-5">Login to your account</h2>
        <form id="loginForm" @submit.prevent="authorize" action="/api/v1/auth/login" method="post">
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn" style="background-color: green; color: white;">Login</button>
        </form>
    </div>
</template>