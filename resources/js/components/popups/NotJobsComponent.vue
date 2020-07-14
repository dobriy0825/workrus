<template>
    <div class="popup_not_jobs">
        <div class="not_jobs">
            <p>У Вас нет действующих заданий!</p>
            <div>
                <button v-on:click="closePopup">Ок</button>
                <button>Создать задание</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        methods: {
            closePopup(){
                this.$store.dispatch('user/closePopup')
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style scoped >

</style>
