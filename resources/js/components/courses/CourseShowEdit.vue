<template>
    <div>
        course edit
    </div>
</template>

<script>
    import useCourses from '../../composables/courses'
    import { onMounted } from 'vue'
    import { useRoute } from 'vue-router'
    export default {
        setup() {
            const { course, getCourse } = useCourses();
            const route = useRoute();
            const course_id = route.params.id;
            onMounted(getCourse(course_id))
            
            // return { course }
        }
    }
</script>