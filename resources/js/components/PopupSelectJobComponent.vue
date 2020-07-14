<template>
    <div>
        <div class="popup_user_jobs">
            <div class="user_jobs">
                <div>
                    <h3 class="user_jobs_title">Выбор задания</h3>
                </div>
                <div class="wrap_tab-link">
                    <span class="user_jobs_tab">Мои задания ({{authenticatedUserJobs.length}})</span>
                    <a href='' class="user_jobs_link">+  Создать задание</a>
                </div>
                <div class="user_jobs_line"></div>
                <div>
                    <div class="cards">
                        <div v-for="(job, index) in authenticatedUserJobs"
                             class="user_jobs_card">
                            <input v-bind:value="job.id"
                                   v-bind:key="index"
                                   v-model="selectedJob"
                                   class="user_jobs_input"
                                   type="radio" name="job_id">
                            <job-preview-component v-bind:job="job"></job-preview-component>
                        </div>
                    </div>
                    <div class="wrap_user_jobs_btn">
                        <button class="user_jobs_btn" v-on:click="proposedJob">Выбрать</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                selectedJob: '',
                currentWorker: this.$store.getters['worker/item'],
            }
        },
        methods: {
            proposedJob(){
                let options = {
                    job_id: this.selectedJob,
                    worker_id: this.currentWorker.id
                };
                this.$store.dispatch('worker/proposedJob', options)
                this.$store.dispatch('user/closeSelectJobPopup')
            },
        },

        computed: {
            authenticatedUserJobs(){
                return this.$store.getters['user/getAuthenticatedUserJobs']
            }
        }
    }
</script>
