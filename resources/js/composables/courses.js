import axios from "axios";
import { ref } from "vue";

export default function useCourses() {
    const courses = ref([])

    const getCourses = async () => {
        const res = await axios.get('/api/courses');;
        try {
            courses.value = res.data
        } catch (err) {
            console.log(err);
        }
    }
    return { courses, getCourses }
}