<template>
    <cat-card
        :username="user.name"
        :image="userImage"
    >
        Que voulez-vous proposer à Minette&#8239;?
    </cat-card>
</template>

<script>
    import CatCard from "./CatCard";

    export default {
        components: { CatCard },
        data() {
            return {
                user: window.user
            }
        },

        computed: {
            userImage() {
                return 'http://minette.test/' + user.image;
            }
        }
    }
</script>
