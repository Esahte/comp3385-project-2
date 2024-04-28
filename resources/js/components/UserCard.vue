<template>
<div class = "user-card">
   <img :src = "user.photo" alt = "Profile Picture">

   <div class "user-name">
       <h2>{{ user.name }}</h2>
       <p>@{{ user.name }}</p>
   </div>

   <div class = "user-biography">
      <p>{{ user.biography }}</p>
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
        fetchUser(user_id) {
            axios.get('api/users/${user_id}')
                 .then(response => {
                    this.user = response.data;
                 })
                 .catch(error => {
                    console.error('Error fetching user:', error);

                 });


        }
    }

}
</script>


