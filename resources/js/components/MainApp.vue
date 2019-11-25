<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <user-card></user-card>
                <minette-card></minette-card>
            </div>
        </div>
    </div>
</template>

<script>
    import UserCard from './UserCard';
    import MinetteCard from './MinetteCard';

    export default {
        name: "MainApp",
        components: {
            UserCard,
            MinetteCard
        }
    }
</script>

<style scoped>

</style>
