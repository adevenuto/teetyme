<template>
    <div v-if="course_data" class="h-screen max-w-6xl p-10 sm:mx-auto">
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center">
            <div class="my-6 sm:order-2">
                <Button @click="initiateNewRound(course_data.course.id)" class="p-button-success" icon="pi pi-flag" label="Play Now" />
            </div>
            <div class="flex-1 my-6 p-float-label sm:order-1 sm:mr-40">
                <InputText id="course_name" class="w-full" type="text" v-model="course_data.course.name" disabled/>
                <label for="course_name">Course Name</label>
            </div>
        </div>
        <TabView>
            <TabPanel v-for="(teebox, i) in course_data.teeboxes" :key="i">
                <template #header>
                    <span>{{ i }} <i @click.stop="editHoleTeeboxName(course_data.course.id, i)" style="font-size: .75rem" class="p-1 text-white rounded prime-blue pi pi-pencil"></i></span>
                </template>
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
                            <Button @click="editHole(hole)" icon="pi pi-pencil" label="Update" />
                        </template>
                    </Card>
                </div>
            </TabPanel>
        </TabView>
    </div>
</template>

<script>
    import { useRoute } from 'vue-router'
    import CourseHoleForm from './CourseHoleForm.vue'
    import CourseHoleTeeboxForm from './CourseHoleTeeboxForm.vue'
    import SetRoundConfig from '../round/SetRoundConfig.vue'
    export default {
        data() {
            return {
                course_id: useRoute().params.id,
                course_data: null,
                dialog_style: {width: '50vw'},
                dialog_breakpoints: {'640px': '90vw'},
            }
        },
        computed: {
            course_teeboxes() {
                const data = this.course_data
                if(data) {
                    return Object.keys(data.teeboxes).map( teebox => {
                        return { teebox }
                    })
                }
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
                const dialogRef = this.$dialog.open(CourseHoleForm, {
                    data: hole,
                    props: {
                        header: `Edit hole #${hole.number}`,
                        style: self.dialog_style,
                        breakpoints: self.dialog_breakpoints,
                    },
                    onClose(options) {
                        // reload data
                        self.getCourse(self.course_id)
                    }
                });
            },
            editHoleTeeboxName(course_id, teebox) {
                const data = {
                    course_id,
                    teebox
                }
                const self = this;
                const dialogRef = this.$dialog.open(CourseHoleTeeboxForm, {
                    data: data,
                    props: {
                        header: `Edit teebox (${data.teebox})`,
                        style: self.dialog_style,
                        breakpoints: self.dialog_breakpoints,
                    },
                    onClose(options) {
                        // reload data
                        self.getCourse(self.course_id)
                    }
                });
            },
            initiateNewRound(course_id) {
                const data = {
                    course_id,
                    teeboxes: this.course_teeboxes,
                }
                const self = this;
                const dialogRef = this.$dialog.open(SetRoundConfig, {
                    data: data,
                    props: {
                        header: `Choose a teebox`,
                        style: self.dialog_style,
                        breakpoints: self.dialog_breakpoints,
                    },
                    onClose(options) {
                        // reload data
                        // self.getCourse(self.course_id)
                    }
                });
            }
        }
    }
</script>

<style scoped>
    .prime-blue {
        background: #2196F3;
    }
    .prime-blue:hover {
        background: #0d89ec;
    }
</style>