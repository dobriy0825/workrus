<template>
    <div>
        <div class="review" v-for="(review, index) in reviews">
            <div class="wrap_avatar_name_type">
                <div class="review__avatar_reviewer"></div>
                <a href="" class="review__name_reviewer">Дмитрий</a>
                <span class="review__type_user">(Заказчик)</span>
            </div>
            <div class="wrap_name_title_job">
                <span class="review__name_section">Задание:</span>
                <a v-bind:href="'/job/' + review.job.id" class="review__title_job">{{ review.job.title}}</a>
            </div>

            <div>
                <span class="review__name_section">Отзыв:</span>
                <p class="review__text">{{ review.text }}</p>
            </div>


            <div class="wrap_stars_pubdate">
                <div>
                    <span class="review__name_section">Оценка:</span>
                    <div class="fa-stars">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                </div>
                <time class="review__pubdate italic">{{ review.created_at}}</time>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['reviews'],
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
