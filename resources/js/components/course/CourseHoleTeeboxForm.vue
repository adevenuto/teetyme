<template>
    <div v-if="hole_data" class="mt-10">
        <div class="mb-8 p-float-label">
            <InputText id="course_name" class="w-full" type="text" v-model="hole_data.new_teebox"/>
            <label for="course_name">Teebox</label>
        </div>
        
        <div class="flex justify-end">
            <div class="mr-4">
                <Button @click="closeDialogRef" class="mr-4 p-button-secondary" label="Cancel"/>
            </div>
            <Button @click="updateTeebox" label="Update" :disabled="!hole_data.new_teebox"/>
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
            async updateTeebox() {
                try {
                    console.log(this.hole_data)
                    const res = await axios.post('/api/hole/teebox/edit/', {
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