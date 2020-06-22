<template>
    <div>
        <button class="proposed_job_btn" v-on:click="addAuthenticatedUserJobs">Предложить задание</button>
        <not-jobs-component v-if="popup"></not-jobs-component>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                popup: false
            }
        },

        methods: {
            addAuthenticatedUserJobs(){
                this.emptyJobs();
                this.$store.dispatch('addAuthenticatedUserJobs');
            },
            emptyJobs(){
                this.popup = this.authenticatedUserJobs < 1;
            }
        },
        computed: {
            authenticatedUserJobs(){
                return this.$store.getters.getAuthenticatedUserJobs;
            },

        }
    }
</script>

