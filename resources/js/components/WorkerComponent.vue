<template>
    <div>
        <div class="wrap_article size_article700">

            <div class="part show_part">
                <div class="wrap_status_views">
                    <span class="status_online">На сайте</span>
                    <span class="" style="color: red;">Был на сайте:</span>
                    <div class="views">
                        <i class="far fa-eye views_icon"></i>
                        <span class="views_number">{{ worker.views }}</span>
                    </div>
                </div>
                <article class="workerStyle my_worker">
                    <span class="worker-id">Анкета № {{ worker.id }}</span>
                    <div class="workerStyle__top">
                        <div>
                            <div class="workerStyle__avatar"></div>
                        </div>
                        <!-- Для мобильных -->
                        <div class="workerStyle__name_surname">
                            <div class="block">
                                <span class="workerStyle__prop">{{ worker.name }}</span>
                                <hr class="workerStyle__line">
                                <a href="" class="workerStyle__val"></a>
                            </div>
                            <div class="block">
                                <span class="workerStyle__prop">Фамилия</span>
                                <hr class="workerStyle__line">
                                <div style="" class="ddd">
                                    <span class="workerStyle__val">{{ worker.surname }}</span>
                                </div>
                            </div>
                        </div>
                        <!-- Для ПК-->
                        <div class="workerStyle__name_surname_sex">
                            <div class="block">
                                <span class="workerStyle__prop">Имя</span>
                                <hr class="workerStyle__line">
                                <a href="" class="workerStyle__val">{{ worker.name }}</a>
                            </div>
                            <div class="block">
                                <span class="workerStyle__prop">Фамилия</span>
                                <hr class="workerStyle__line">
                                <span class="workerStyle__val">{{ worker.surname }}</span>
                            </div>
                            <div class="block">
                                <span class="workerStyle__prop">Пол</span>
                                <hr class="workerStyle__line">
                                <span class="workerStyle__val">{{ worker.sex }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Убрать для ПК-->
                    <div class="block sex">
                        <span class="workerStyle__prop">Пол</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val">{{ worker.sex }}</span>
                    </div>

                    <div class="block">
                        <span class="workerStyle__prop">Город</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val ">{{ worker.city }}</span>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Выполнено заданий</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val italic">{{ worker.tasks_completed }}</span>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Рейтинг</span>
                        <hr class="workerStyle__line">
                        <div class="ddd">
                            <span class="workerStyle__val italic">{{ worker.rating }}</span>
                        </div>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">О себе</span>
                        <hr class="workerStyle__line">
                        <p class="workerStyle__val">{{ worker.about_me }}</p>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Виды выполняемых работ</span>
                        <hr class="workerStyle__line">
                        <button class="show_types_of_jobs_btn">Показать</button>
                    </div>
                    <div class="block">
                        <span class="workerStyle__prop">Создано</span>
                        <hr class="workerStyle__line">
                        <span class="workerStyle__val italic">{{ worker.created_at }}</span>
                    </div>
                </article>
                <div v-if="authenticated">
                    <button class="edit_worker_btn" v-if="workerOwn">Редактировать анкету</button>
                    <button class="offer_job_btn" v-else>Предложить задание</button>
                </div>
                <span class="authorization_warning" v-else>Предложить своё Задание могут только авторизованные пользователи !</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            user: Object,
            worker: Object,
            world: String
        },
        data(){
            return {
                authenticated: this.world,
                workerOwn: false
            }
        },
        methods: {
        },
        created() {
            console.log(this.world)
        }
    }
</script>
