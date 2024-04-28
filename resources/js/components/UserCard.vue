<template>
<div class = "user-card">
   <img :src = "user.photo" alt = "Profile Picture">

   div class "user-name"
       <h2>{{ user.name }}</h2>
       <p>@{{ user.name }}</p>
   </div>

   <div class = "user-details">
        <p>Email:: {{ user.email }}</p>
        <p>Location:: {{ user.location }}</p>
        
   </div>
</div>
</template>

<script>
export default {
    props: {
        user: Object
    }
}
</script>
