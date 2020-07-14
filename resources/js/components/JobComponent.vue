<template>
    <div>
        <div  v-for="job in jobs">

            <div v-show="activeTab === 'addProposedJobs'">

            </div>
        </div>




    </div>

</template>
<script>
    export default {
        props: ['type', 'jobs'],
        data(){
            return {
            }
        },
        methods: {
            hiredJobs(id){
                this.$store.dispatch('hiredJobs', id);
            }
        },
        computed: {
            activeTab(){
                return this.$store.getters.getActiveTab
            },
            u(){
                console.log(this.jobs.length);
                return this.jobs.length > 0
            },

        },
        mounted() {
            console.log(this.u)
        }
    }
</script>
