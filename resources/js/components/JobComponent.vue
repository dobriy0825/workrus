<template>
    <div>
        <div class="card">
            <div class="data">
                <div class="data__topRow">
                    <a href="" class="topRow__name">Убрать 1 комнатную квартиру</a>
                    <p class="topRow__price">цена: <span>20000</span>р.</p>
                </div>
                <p class="data__description">Lorem ipsum dolor sit amet, consectetur ad...</p>
                <div class="data__bottomRow">
                    <p class="bottomRow__create">создание: 20.05.2019 17:35</p>
                    <a href="" class="bottomRow__detailed">Подробнее</a>
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
                jobs: [],
                job: {
                    id: '',
                    title: '',
                    price: '',
                    description: '',
                    created_at: ''
                }
            }
        }
    }
</script>
