<template>
    <div>
        <div class="card"
             v-for="job in proposedJob">
            <div class="data">
                <div class="data__topRow">
                    <a href="" class="topRow__name">{{ job.title }}</a>
                    <p class="topRow__price">цена: <span>{{ job.price }}</span>р.</p>
                </div>
                <p class="data__description">{{ job.description }}</p>
                <div class="data__bottomRow">
                    <p class="bottomRow__create">создание: {{ job.created_at }}</p>
                    <a :href="'/job/' + job.id" class="bottomRow__detailed">Подробнее</a>
                </div>
            </div>
        </div>
        <div>
            <button>Да</button>
            <button>Нет</button>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
            }
        },
        computed: {
            proposedJob(){
                return this.$store.getters.getProposedJob;
            }
        },
        mounted() {

        }
    }
</script>
