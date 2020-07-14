<template>
    <div>
        <div class="wrap_name_section">
            <span class="name_section"
                  v-for="(item, index) in menuList"
                  v-bind:key="index"
                  v-if="showMenu(item.authenticatedUserWorker)"
                  v-bind:class="{name_section__active: item.content === activeMenu}"
                  v-on:click="the(item.content)"
            >{{ item.value }}</span>
        </div>

        <div class="line_section" style="margin-bottom: 10px;"></div>

        <div class="cards">
            <div class="proposedJobs" v-if="activeMenu === 'addProposedJobs'">
                <div v-if="proposedJobs.length  !== 0">
                    <div v-for="(job) in proposedJobs">
                        <job-preview-component v-bind:job="job"></job-preview-component>
                        <button v-on:click="hiredJob(job.id)">Принять задание</button>
                    </div>
                </div>
                <div v-else>
                    <p>Нет предложенных заданий.</p>
                </div>
            </div>

            <div class="hiredJobs" v-else-if="activeMenu === 'addHiredJobs'">
                <div v-if="hiredJobs.length  !== 0">
                    <div v-for="(job) in hiredJobs">
                        <job-preview-component v-bind:job="job"></job-preview-component>
                    </div>
                </div>
                <div v-else>
                    <p>Нет принятых заданий.</p>
                </div>
            </div>

            <div class="userJob" v-else-if="activeMenu === 'addMyProposedJob'">

                <div v-if="userJob.length  !== 0">
                    <div v-for="(job) in userJob"
                         v-if="job.user_id === authenticatedUser.id">
                        <job-preview-component v-bind:job="job"></job-preview-component>
                        <button v-on:click="whthdrawJob(job.id)">Отозвать {{ job.id }}</button>
                    </div>
                </div>

                <div v-else>
                    <p>Нет вашего заданий.</p>
                </div>
            </div>

        </div>
    </div>

</template>


<!--        <div class="reviews">-->
<!--            <div class="cards">-->
<!--                <div>-->
<!--                    <div></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div v-else>-->
<!--                <p>Нет отзывов.</p>-->
<!--            </div>-->
<!--        </div>-->
<!--        <div class="userJob">-->
<!--            <div class="cards">-->
<!--                <div>-->
<!--                    <job-preview-component v-bind:job="job"></job-preview-component>-->
<!--                    <button>Отозвать задание</button>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div v-else>-->
<!--                <p>Нет Вашего задания.</p>-->
<!--            </div>-->
<!--        </div>-->



<script>
    export default {
        data(){
            return {
                currentWorker: this.$store.getters['worker/item'],
                menuList: this.$store.getters['menu/items'],
                activeMenu: '',
            }
        },
        methods: {
           showMenu(value){
                let result = this.authenticatedUser.id === this.currentWorker.user_id;
                if ((value === 'auth') === result){
                    return true
                }else if ((value === 'not auth') === result){
                    return false
                }else if (value === 'all'){
                    return 'all'
                }
            },
            defaultActiveMenu(){
                let content;
                if (this.authenticatedUser.id === this.currentWorker.id){
                    content = 'addProposedJobs';

                }else {
                    content = 'addMyProposedJob';
                }
                console.log(content)
                return content;
            },
            setActiveMenu(content){
                console.log(content)
                this.activeMenu = content;
            },
            loadProposedJobs(){
                this.$store.dispatch('worker/loadProposedJobs', this.currentWorker.id)
            },
            loadHiredJobs(){
                this.$store.dispatch('worker/loadHiredJobs', this.currentWorker.id)
            },
            the(content){
               this.setActiveMenu(content)
               if (content === 'addProposedJobs'){
                   this.loadProposedJobs();
               }else if (content === 'addHiredJobs'){
                   this.loadHiredJobs();
               }else if (content === 'addReviews'){
                   return 1;
               }
            },
            hiredJob(job_id){
               this.$store.dispatch('worker/hiredJobs', {job_id: job_id, worker_id: this.currentWorker.id})
            },
            whthdrawJob(job_id){
               this.$store.dispatch('worker/deleteProposedJob', {job_id: job_id, worker_id: this.currentWorker.id})
            }

        },
        computed: {
            authenticatedUser(){
                return this.$store.getters['user/item']
            },
            jobs(){
                return this.$store.getters['user/getAuthenticatedUserJobs']
            },
            proposedJobs(){
                return this.$store.getters['worker/getProposedJobs']
            },
            hiredJobs(){
                return this.$store.getters['worker/getHiredJobs']
            },
            userJob(){
                return this.$store.getters['worker/getUserJob']
            }
        },
        created() {
            this.activeMenu = this.defaultActiveMenu();
            this.loadProposedJobs();

        }
    }
</script>
