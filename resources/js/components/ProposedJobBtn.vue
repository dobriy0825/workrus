<template>
    <div>
        <button class="proposed_job_btn" v-on:click="r">Предложить задание</button>
        <not-jobs-component v-if="notJobsPopup"></not-jobs-component>
        <popup-select-job-component v-if="selectJobPopup"></popup-select-job-component>
    </div>
</template>

<script>
    export default {
        data(){
            return {
            }
        },

        methods: {
            r(){
                this.$store.dispatch('user/loadAuthenticatedUserJobs')
            },
        },
        computed: {
            notJobsPopup(){
                return this.$store.getters['user/getNotJobsPopup']
            },
            selectJobPopup(){
                return this.$store.getters['user/getSelectJobPopup']
            }
        }
    }
</script>

