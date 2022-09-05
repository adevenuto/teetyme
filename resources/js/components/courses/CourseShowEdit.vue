<template>
    <div v-if="course_data" class="max-w-6xl p-10 shadow-lg sm:mx-auto">

        <div class="my-6">
            <span class="p-float-label">
                <InputText id="course_name" class="w-full md:w-1/2" type="text" v-model="course_data.course.name" />
                <label for="course_name">Course Name</label>
            </span>
        </div>

        <TabView>
            <TabPanel v-for="(teebox, i) in course_data.teeboxes" :key="i" :header="i">
                <div class="grid grid-cols-1 gap-8 sm:grid-cols-3 md:grid-cols-4">
                    <Card  v-for="hole in teebox" :key="hole.id">
                        <template #title>
                            Hole #{{ hole.number }}
                            <hr class="mt-3 mb-2">
                        </template>
                        <template #content>
                            <div class="flex mb-2 text-lg">
                                <span class="w-16 px-2 border border-gray-100 rounded-l bg-gray-50">Par</span>
                                <span class="w-16 px-2 border border-gray-100 rounded-r bg-gray-50">{{ hole.par }}</span>
                            </div>
                            <div class="flex mb-2 text-lg">
                                <span class="w-16 px-2 border border-gray-100 rounded-l bg-gray-50">Yds</span>
                                <span class="w-16 px-2 border border-gray-100 rounded-r bg-gray-50">{{ hole.length_yds }}</span>
                            </div>
                            <div class="flex mb-2 text-lg">
                                <span class="w-16 px-2 border border-gray-100 rounded-l bg-gray-50">M</span>
                                <span class="w-16 px-2 border border-gray-100 rounded-r bg-gray-50">{{ hole.length_m }}</span>
                            </div>
                            <div class="flex text-lg">
                                <span class="w-16 px-2 border border-gray-100 rounded-l bg-gray-50">SI</span>
                                <span class="w-16 px-2 border border-gray-100 rounded-r bg-gray-50">{{ hole.stroke_index }}</span>
                            </div>
                        </template>
                        <template #footer>
                            <Button @click="editHole(hole)" icon="pi pi-pencil" label="Edit" />
                        </template>
                    </Card>
                </div>
            </TabPanel>
        </TabView>
        <Toast />
    </div>
</template>

<script>
    import { useRoute } from 'vue-router'
    import CourseForm from './CourseForm.vue'
    export default {
        data() {
            return {
                course_id: useRoute().params.id,
                course_data: null,
                selectedHole: null
            }
        },
        created() {
            this.getCourse(this.course_id)
        },
        methods: {
            async getCourse(id=null) {
                if(!id) return 'course id required to get course';
                try {
                    const res = await axios.get(`/api/course/${id}`);
                    this.course_data = res.data
                } catch (err) {
                    console.log(err);
                }
            },
            editHole(hole) {
                const self = this;
                const dialogRef = this.$dialog.open(CourseForm, {
                    data: hole,
                    props: {
                        header: `Edit hole #${hole.number}`,
                        style: {
                            width: '50vw'
                        },
                        breakpoints:{
                            '640px': '90vw'
                        },
                    },
                    onClose(options) {
                        // reload data
                        self.getCourse(self.course_id)
                    }
                });
                
                this.selectedHole = hole
            }
        }
    }
</script>

<style scoped>
</style>