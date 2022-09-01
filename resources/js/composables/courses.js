import axios from "axios";
import { ref } from "vue";

export default function useCourses() {
    const courses   = ref([])
    const course    = ref({})

    const getCourses = async () => {
        const res = await axios.get('/api/courses');;
        try {
            courses.value = res.data
        } catch (err) {
            console.log(err);
        }
    }
    const getCourse = async (id) => {
        const res = await axios.get(`/api/course/${id}`);
        try {
            console.log(res)
            // courses.value = res.data
        } catch (err) {
            console.log(err);
        }
    }
    return { courses, getCourses, course, getCourse }
}