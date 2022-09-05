<template>
    <ul class="p-10">
        <div class="pb-6">
            <router-link to="/">Home</router-link>
        </div>
        <span class="p-fluid">
            <AutoComplete
                v-model="selected_course" 
                :suggestions="courses_data" 
                :field="(item) => item.name"
                @complete="searchCourses($event)" 
            />
        </span>
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
        },
        watch: {
            selected_course(val=null) {
                if(val && val.constructor.name === "Object") this.selectionHandler()
            }
        },
        methods: {
            async searchCourses(event) {
                try {
                    const res = await axios.get('/api/courses', {params: {term: event.query}})
                    this.courses_data = res.data
                } catch (err) {
                    console.log(err)
                }
            },
            selectionHandler() {
                setTimeout(() => { // settimeout used due to wierd 'Cannot read properties of null (reading 'focus')' error when course selected
                    this.$router.push({ path: `/course/${this.selected_course.id}` })
                }, 1);
            }
        }
    }

   
</script>

