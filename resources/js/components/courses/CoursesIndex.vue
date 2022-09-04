<template>
    <ul class="p-10">
        <div class="pb-6">
            <router-link to="/">Home</router-link>
        </div>
        <AutoComplete 
            v-model="selected_course" 
            :suggestions="courses_data" 
            :field="(item) => item.name"
            @complete="searchCourses($event)" 
        />
    </ul>
</template>

<script>
    export default {
        data() {
            return {
                courses_data: null,
                selected_course: null
            }
        },
        created() {
            // this.getCourses()
        },
        watch: {
            selected_course(val=null) {
                if(val && val.constructor.name === "Object") this.selectionHandler()
            }
        },
        methods: {
            async searchCourses(event) {
                const res = await axios.get('/api/courses', {params: {term: event.query}})
                try {
                    this.courses_data = res.data
                } catch (err) {
                    console.log(err)
                }
            },
            selectionHandler() {
                setTimeout(() => {
                    this.$router.push({ path: `/course/${this.selected_course.id}` })
                }, 100);
            },
            test(event) {
                console.log(event)
            }
        }
    }
</script>