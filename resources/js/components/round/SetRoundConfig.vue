<template>
    <div>
        <Dropdown v-model="selected_teebox" :options="course_teeboxes" optionLabel="teebox" placeholder="Select a teebox" />
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
        computed: {
            course_teeboxes() {
                const data = this.round_data
                if(data) {
                    return Object.keys(data.teeboxes).map( teebox => {
                        return { teebox }
                    })
                }
            }
        },
        created() {
            this.round_data = JSON.parse(this.dialogRef.data); // disconnect reactivity
        },
        methods: {
            closeDialogRef() {
                this.isLoading = false
                this.dialogRef.close()
            },
            startRound() {
                this.isLoading = true
                const round_data = {
                    course: this.round_data.course,
                    teebox: this.selected_teebox.teebox,
                    holes: this.round_data.teeboxes[this.selected_teebox.teebox]
                }
                this.$store.commit('setRoundData', round_data)
                this.$router.push({name: 'RoundIndex'})
                this.closeDialogRef()
            }
        }
    }
</script>

<style lang="scss" scoped>

</style>