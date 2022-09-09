<template>
    <div>
        <Dropdown v-model="selected_teebox" :options="round_data.teeboxes" optionLabel="teebox" placeholder="Select a teebox" />
        <div class="flex justify-end">
            <div class="mr-4">
                <Button @click="closeDialogRef" class="mr-4 p-button-secondary" label="Cancel"/>
            </div>
            <Button @click="startRound" label="Start Round" :disabled="!selected_teebox" :loading="isLoading"/>
        </div>
    </div>
</template>

<script>
    export default {
        inject: ['dialogRef'],
        data() {
            return {
                round_data: null,
                selected_teebox: null,
                isLoading: false
            }
        },
        created() {
            this.round_data = Object.assign({}, this.dialogRef.data); // disconnect reactivity
        },
        methods: {
            closeDialogRef() {
                this.isLoading = false
                this.dialogRef.close()
            },
            async startRound() {
                try {
                    const data = {
                        course_id: this.round_data.course_id,
                        selected_teebox: this.selected_teebox.teebox
                    }
                    this.isLoading = true
                    const res = await axios.post('/api/round/create', {
                        round_data: JSON.stringify(data)
                    });
                    if(res.status === 200) this.closeDialogRef()
                } catch (err) {
                    console.log(err);
                }
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>