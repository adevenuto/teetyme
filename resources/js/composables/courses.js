import axios from "axios";
import { ref, computed } from "vue";

export default function useCourses() {
    // const courses   = ref([])
    // const course    = ref([])

    // const getCourses = async () => {
    //     const res = await axios.get('/api/courses');;
    //     try {
    //         courses.value = res.data
    //     } catch (err) {
    //         console.log(err);
    //     }
    // }
    // const getCourse = async (id) => {
    //     const res = await axios.get(`/api/course/${id}`);
    //     try {
    //         course.value = res.data
    //     } catch (err) {
    //         console.log(err);
    //     }
    // }
    // const courseDataSet = computed(() =>{
    //     return Object.keys(course.value).length !== 0;
    // });
    // return { courses, getCourses, course, courseDataSet, getCourse }
}