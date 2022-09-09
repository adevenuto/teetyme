<template>
    <div class="h-screen max-w-6xl p-10 sm:mx-auto">
        <div class="pt-10 mx-6 p-fluid">
            <AutoComplete
                v-model="selected_course" 
                :suggestions="courses_data" 
                :field="(item) => item.name"
                @complete="searchCourses($event)"
                placeholder="Search courses..." 
                panelClass="w-full"
                appendTo="self"
            />
        </div>
    </div>
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
<style scoped>
    .p-autocomplete-panel .p-autocomplete-items .p-autocomplete-item {
        margin: 0 !important;
    }
</style>
