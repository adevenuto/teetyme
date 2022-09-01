<template>
    <div v-if="courseDataSet">
        <h1>{{ course.course.name }}</h1>
        <br>
        <div v-for="(teebox, i) in course.teeboxes" :key="i">
            <h3>{{ i }}</h3> <!-- teebox name -->
            
            <div v-for="hole in teebox" :key="hole.id">
                <strong>Hole: {{ hole.number }}</strong>, 
                <small>Par: {{ hole.par }}</small>, 
                <small>Length: {{ hole.length_yds }}</small>
            </div>
            <br>
        </div>
    </div>
</template>

<script>
    import useCourses from '../../composables/courses'
    import { onMounted } from 'vue'
    import { useRoute } from 'vue-router'
    export default {
        setup() {
            const { course, courseDataSet, getCourse } = useCourses();
            const route = useRoute();
            const course_id = route.params.id;
            onMounted(getCourse(course_id))
            
            return { course, courseDataSet }
        }
    }
</script>