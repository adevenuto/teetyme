<template>
    <ul class="p-10">
        <div class="pb-6">
            <router-link to="/">Home</router-link>
        </div>
        <div v-if="courses">
            <li v-for="course in courses" :key="course.id">
                <a :href="`/course/${course.id}`">{{ course.name }}</a>
            </li>
        </div>
        <div else>Loading</div>
        
    </ul>
</template>

<script>
    import useCourses from '../../composables/courses'
    import { onMounted } from 'vue'
    export default {
        setup() {
            const { courses, getCourses } = useCourses();
            onMounted(getCourses)

            return { courses }
        }
    }
</script>