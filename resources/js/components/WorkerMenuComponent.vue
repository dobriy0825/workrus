<template>
    <div>
        <div class="wrap_name_section">
            <span class="name_section name_section__active" data-content="part_proposed_jobs">Предложенные задания (1)</span>
            <span class="name_section" data-content="part_hired_jobs">Принятое задание</span>
            <span class="name_section name_section__active" data-content="part_your_job">Ваше задание</span>
            <span class="name_section" data-content="part_reviews">Отзывы (0)</span>
        </div>
        <div class="line_section" style="margin-bottom: 10px;"></div>

        <div class="part  show_parte tab">
            <div class="cards">
                <job-component></job-component>
            </div>

        </div>

    </div>
</template>

<script>
    export default {
        data(){
            return {

            }
        }
    }
</script>
