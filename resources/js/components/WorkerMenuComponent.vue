<template>
    <div>
        <div class="wrap_name_section">
            <span class="name_section"
                  v-for="(item, index) in menuList"
                  v-bind:key="index"
                  v-if="showMenu(item.authenticatedUserWorker)"
                  v-bind:type="item.content"
                  v-bind:class="{name_section__active: item.content === activeMenu}"
            >{{ item.value }}</span>
        </div>
        <div class="line_section" style="margin-bottom: 10px;"></div>


        <div class="cards">
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

                activeMenu: ''
            }
        },
        methods: {
            showMenu(value){
                let res = this.user.id === this.worker.user_id;
                if ((value === 'auth') === res){
                    return true
                }else if ((value === 'not auth') === res){
                    return false
                }else if (value === 'all'){
                    return 'all'
                }
            },
            defaultActiveMenu(){
                let content;
                if (this.user.id === this.worker.id){
                    content = 'addProposedJobs';

                }else {
                    content = 'addMyProposedJob';
                }
                return content;
            },
            setActiveMenu(){

            }

        },
        computed: {
            menuList() {
                return this.$store.getters['menu/items']
            },
            datas(){
                if (this.activeTab === 'addProposedJobs'){
                    return this.$store.getters.getProposedJobs
                }else if (this.activeTab === 'addHiredJobs'){
                    return this.$store.getters.getHiredJobs
                }else if (this.activeTab === 'addReviews'){
                    return this.$store.getters.getReviews
                }else if (this.activeTab === 'addMyProposedJob'){
                    return this.$store.getters.getMyProposedJob
                }
            },
        },
        created() {
            this.activeMenu = this.defaultActiveMenu;
        }
    }
</script>
