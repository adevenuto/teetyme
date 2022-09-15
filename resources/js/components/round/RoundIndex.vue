<template>
    <div>
        Round
        {{ this.$store.getters.get_round_data }}
    </div>
</template>

<script>
    import store from '../../store'
    import router from '../../router'
    export default {
        beforeRouteLeave(to, from, next) {
            if (!window.confirm("Leave round? Are you sure?")) return
            localStorage.removeItem('round_data')
            next();
        },
        beforeRouteEnter(to, from, next) {
            if(store.getters.get_round_data == null) next({name: 'Courses'})
            next()
        }
    }
</script>

<style lang="scss" scoped>

</style>