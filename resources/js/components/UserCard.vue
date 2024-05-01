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
    mounted() {
        this.fetchUser(this.user_id);
    },
    methods: {
        async fetchUser(user_id) {
            try {
                const response = await fetch(`/api/v1/users/${user_id}`, {
                    headers: {
                        Accept: "application/json",
                        'Authorization': 'Bearer ' + localStorage.getItem('token')
                    }
                });
                this.user = await response.json();
            } catch (error) {
                console.error(error);
            }
        }
    }
}
</script>

<template>
    <div v-if="user" class="card user-profile shadow mb-5">
        <div class="row g-0">
            <div class="user-profile-image">
                <img :src="'/storage/' + user.photo" alt="User Profile" class="img-thumbnail rounded-circle">
            </div>
            <div class="col-12 col-md-8 col-lg-9">
                <div class="card-body">
                    <h2>{{ user.name }}</h2>
                    <h4 style="color: #6c757d;">@{{ user.username }}</h4>
                    <p class="text-muted">{{ user.biography }}</p>
                    <div class="user-details mt-3">
                        <div class="row gx-2 detail mb-3">
                            <div class="col text-start">
                                <span class="detail-title text-muted">Email:</span>
                            </div>
                            <div class="col text-start">
                                <span class="detail-value">{{ user.email }}</span>
                            </div>
                        </div>
                        <div class="row gx-2 detail mb-3">
                            <div class="col text-start">
                                <span class="detail-title text-muted">Location:</span>
                            </div>
                            <div class="col text-start">
                                <span class="detail-value">{{ user.location }}</span>
                            </div>
                        </div>
                        <div class="row gx-2 detail mb-3">
                            <div class="col text-start">
                                <span class="detail-title text-muted">Joined:</span>
                            </div>
                            <div class="col text-start">
                                <span class="detail-value">{{ user.created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.img-thumbnail {
    padding: 0;
}

.detail {
    display: grid;
    grid-template-columns: 1fr 1fr; /* Two equal columns */
    justify-content: start; /* Align items to the left */
    gap: 20px; /* Adjust as needed */
}

.user-profile-image {
    grid-column: 1 / 2; /* The image occupies the first column */
    width: 80%; /* Adjust size as needed */
    height: auto; /* Maintain aspect ratio */
    object-fit: cover; /* Cover the parent container */
    margin: 20px;
}

.row {
    display: grid;
    grid-template-columns: 1fr 2fr; /* Adjust as needed */
}

.user-profile img {
    width: 100%; /* Adjust size as needed */
    height: auto; /* Maintain aspect ratio */
    object-fit: cover; /* Cover the parent container */
    margin: 20px;
}

.card-body {
    grid-column: 2 / 3; /* The card body occupies the second column */
}

.user-profile {
    background: #fff;
}

.detail-title {
    color: #6c757d;
}

.detail-value {
    color: #000;
    font-weight: 500;
}

.card {
    border-radius: 15px; /* Rounded corners */
}

.shadow {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
</style>


