<template>
    <div>
        <div class="cards">
            <job-component v-bind:d="jobs"></job-component>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['jobs'],
    }
</script>
