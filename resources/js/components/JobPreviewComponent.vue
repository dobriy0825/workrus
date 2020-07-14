<template>
    <div>
        <div class="card">
            <div class="data">
                <div class="data__topRow">
                    <a href="" class="topRow__name">{{ job.title }}</a>
                    <p class="topRow__price">цена: <span>{{ job.price }}</span>р.</p>
                </div>
                <p class="data__description">{{ job.description.substr(0, 83) }}</p>
                <div class="data__bottomRow">
                    <p class="bottomRow__create">создание: {{ job.created_at }}</p>
                    <a :href="'/job/' + job.id" class="bottomRow__detailed">Подробнее</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['job'],
    }
</script>
