<template>
    <a @click.prevent="logout" href="#">Logout</a>
</template>
<script>
    export default {
        methods: {
            logout() {
                this.$store.commit('setLogOut')
            }
        }
    }
</script>