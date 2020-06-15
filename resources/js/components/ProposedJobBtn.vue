<template>
    <div>
        <button class="proposed_job_btn" v-on:click="addAuthenticatedUserJobs">Предложить задание</button>
    </div>
</template>

<script>
    export default {
        methods: {
            addAuthenticatedUserJobs(){
                this.$store.dispatch('addAuthenticatedUserJobs');
            },
        },
    }
</script>

<style scoped>

</style>
