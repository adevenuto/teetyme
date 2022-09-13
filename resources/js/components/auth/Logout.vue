<template>
    <a @click.prevent="logout" href="#">Logout</a>
</template>
<script>
    export default {
        methods: {
            async logout() {
                try {
                    const logout = await axios.post('/logout')
                    if(logout.status === 200) {
                        sessionStorage.removeItem('loggedIn')
                        this.$router.push({path: '/login'})
                    }
                } catch (err) {
                    console.log(err);
                }
            }
        }
    }
</script>