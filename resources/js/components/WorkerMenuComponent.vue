<template>
    <div>
        <div class="wrap_name_section">
            <span class="name_section"
                  v-for="(item, index) in menuList"
                  v-bind:key="index"
                  v-if="showTab(item.authenticatedUserWorker)"
                  v-bind:type="item.content"
                  v-on:click="setActiveTab(item.content)"
                  v-bind:class="{name_section__active: activeTab === item.content}"
            >{{ item.value }}</span>
        </div>
        <div class="line_section" style="margin-bottom: 10px;"></div>
        <div class="cards">
            <review-component v-if="activeTab === 'addReviews'"
                              v-bind:reviews="datas"></review-component>
            <job-component v-else
                           v-bind:jobs="datas"></job-component>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                user: this.$store.getters.getAuthenticatedUser,
                worker: this.$store.getters.getWorker,
                type: '',
                menuList: this.$store.getters.getMenu,
                isActive: false
            }
        },
        methods: {
            showTab(value){
                let res = this.user.id === this.worker.user_id;
                if ((value === 'auth') === res){
                    return true
                }else if ((value === 'not auth') === res){
                    return false
                }else if (value === 'all'){
                    return 'all'
                }
            },
            addData(content){
                this.type = content;
                this.$store.dispatch(content);
            },
            setActiveTab(content){
                if (content !== this.activeTab){
                    this.$store.dispatch('addActiveTab', content);
                    console.log(content);
                    this.addData(content);
                    this.isActive = true;
                }
            },
            setActive(){

            }
        },
        computed: {
            activeTab(){
                return this.$store.getters.getActiveTab
            },
            datas(){
                if (this.activeTab === 'addProposedJobs'){
                    return this.$store.getters.getProposedJobs
                }else if (this.activeTab === 'addHiredJobs'){
                    return this.$store.getters.getHiredJobs
                }else if (this.activeTab === 'addReviews'){
                    return this.$store.getters.getReviews
                }else if (this.activeTab === 'addProposed'){
                    return this.$store.getters.getProposed
                }
            },
        },
    }
</script>
