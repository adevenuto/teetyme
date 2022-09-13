<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="px-8 py-6 mt-4 text-left bg-white shadow-lg">
            <h3 class="text-2xl font-bold text-center">Login to your account</h3>
            <div class="mt-4">
                <div>
                    <label class="block" for="email">Email</label>
                    <input id="email" type="text" placeholder="Email" v-model="form_data.email" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="mt-4">
                    <label class="block" for="password">Password</label>
                    <input id="password" type="password" placeholder="Password" v-model="form_data.password" class="w-full px-4 py-2 mt-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-600">
                </div>
                <div class="flex items-baseline justify-between">
                    <button @click="Login" class="px-6 py-2 mt-4 text-white bg-blue-600 rounded-lg hover:bg-blue-900">Login</button>
                    <a href="#" class="text-sm text-blue-600 hover:underline">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                form_data: {
                    email: null,
                    password: null
                }
            }
        },
        methods: {
            async Login() {
                try {
                    const initCsrf = await axios.get('/sanctum/csrf-cookie');
                    if(initCsrf.status === 204) {
                        const login = await axios.post('/login', this.form_data, {
                            headers: {
                                'Accept': 'application/json'
                            }
                        })
                        if(login.status === 200) {
                            sessionStorage.setItem('loggedIn', true)
                            this.$router.push({path: '/courses'})
                        }
                    }
                } catch (err) {
                    console.log(err);
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>