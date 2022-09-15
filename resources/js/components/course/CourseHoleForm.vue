<template>
    <div v-if="hole_data" class="mt-10">
        <div class="mb-8 p-float-label">
            <InputText id="course_name" class="w-full" type="text" v-model="hole_data.par" />
            <label for="course_name">Par</label>
        </div>
        <div class="mb-8 p-float-label">
            <InputText id="course_name" class="w-full" type="text" v-model="hole_data.length_yds" />
            <label for="course_name">Length Yds</label>
        </div>
        <div class="mb-8 p-float-label">
            <InputText id="course_name" class="w-full" type="text" v-model="hole_data.length_m" />
            <label for="course_name">Length M</label>
        </div>
        <div class="mb-8 p-float-label">
            <InputText id="course_name" class="w-full" type="text" v-model="hole_data.stroke_index" />
            <label for="course_name">SI</label>
        </div>
        <div class="flex justify-end">
            <div class="mr-4">
                <Button @click="closeDialogRef" class="mr-4 p-button-secondary" label="Cancel"/>
            </div>
            <Button @click="updateHoleData" label="Update"/>
        </div>
    </div>
</template>

<script>
    export default {
        inject: ['dialogRef'],
        data() {
            return {
                hole_data: null
            }
        },
        created() {
            this.hole_data = JSON.parse(this.dialogRef.data); // disconnect reactivity
        },
        methods: {
            closeDialogRef() {
                this.dialogRef.close();
            },
            async updateHoleData() {
                try {
                    const res = await axios.post('/api/hole/edit/', {
                        hole_data: JSON.stringify(this.hole_data)
                    });
                    if(res.status === 200) this.closeDialogRef()
                } catch (err) {
                    console.log(err);
                }
            }
        }
    }
</script>