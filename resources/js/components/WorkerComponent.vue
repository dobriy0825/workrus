<template>
    <div>
        <worker-menu-component></worker-menu-component>
    </div>
</template>

<script>
    export default {
        props: ['authenticatedUser', 'worker'],
        computed: {

        },
        created() {
            this.$store.dispatch('user/load', this.authenticatedUser);
            this.$store.dispatch('worker/loadWorker', this.worker);
        }

    }
</script>
