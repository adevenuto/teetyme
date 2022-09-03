<template>
    <ul class="p-10">
        <div class="pb-6">
            <router-link to="/">Home</router-link>
        </div>
        <div v-if="courses_data">
            <li v-for="course in courses_data" :key="course.id">
                <router-link :to="`/course/${course.id}`">{{ course.name }}</router-link>
            </li>
        </div>
        <div else>Loading</div>
        
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                courses_data: null
            }
        },
        created() {
            this.getCourses()
        },
        methods: {
            async getCourses() {
                const res = await axios.get('/api/courses')
                try {
                    this.courses_data = res.data
                } catch (err) {
                    console.log(err)
                }
            }
        }
    }
</script>