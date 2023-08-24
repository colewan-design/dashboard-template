<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3>Dashboard</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">You are logged in as <b>{{user.email}}</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"dashboard",
    data() {
        return {
            user: {},
        };
    },

    async mounted() {
        try {
            const response = await axios.get('/user');
            this.user = response.data;
        } catch (error) {
            console.error('Error fetching user data:', error);
        }
    }
}
</script>