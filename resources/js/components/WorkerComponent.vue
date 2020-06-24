<template>
    <div>
        <worker-menu-component></worker-menu-component>
    </div>
</template>

<script>
    export default {
        props: ['authenticatedUser', 'worker'],
        data(){
            return {

            }
        },
        methods: {
        },
        computed: {
            user(){
                return this.$store.getters.getAuthenticatedUser
            },
            workerC(){
                return this.$store.getters.getWorker
            },
            proposedJob(){
                return this.$store.getters.getProposedJobs
            },
            reviews(){
                return this.$store.getters.getReviews
            }
        },
        created() {
            this.$store.dispatch('addAuthenticatedUser', this.authenticatedUser);
            this.$store.dispatch('addWorker', this.worker);
        }
    }
</script>
