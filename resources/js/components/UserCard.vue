<template>
<div class="user-card">
   <img :src="user.photo" alt="Profile Picture">

   <div class="user-name">
       <h2>{{ user.name }}</h2>
       <p>@{{ user.name }}</p>
   </div>

   <div class="user-biography">
      <p>{{ user.biography }}</p>
   </div>

   <div class="user-details">
        <p>Email: {{ user.email }}</p>
        <p>Location: {{ user.location }}</p>
   </div>
</div>
</template>

<script>
export default {
    props: {
        user_id: Number
    },
    data() {
        return {
            user: null
        };
    },
    mounted(){
        this.fetchUser(this.user_id);
    },


    methods: {
        async fetchUser(user_id) {
            try {
                const response = await fetch(`/api/v1/users/${user_id}`, {
                    headers: {
                        Accept: "application/json",
                        'Authorization': 'Bearer ' + localStorage.getItem('user_id')
                    }
                });

                const data = await response.json();
                this.user = data.user;

            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>
