<template>
    <cat-card
        username="Minette"
        image="http://minette.test/img/minette.jpg"
    >
        <div v-if="minetteAnswer">
            {{ minetteAnswer }}
        </div>

        <div v-else>
            <button class="btn btn-outline-info" @click="askMinette('sex')">Sexe</button>
            <button class="btn btn-outline-info" @click="askMinette('love')">Amour</button>
        </div>
    </cat-card>
</template>

<script>
    import CatCard from "./CatCard";

    export default {
        components: { CatCard },

        data() {
            return {
                minetteAnswer: '',
            }
        },

        methods: {
            askMinette(relation) {
                axios.get('http://minette.test/api/' + relation)
                    .then(response => {
                        console.log(response.data);
                        this.minetteAnswer = response.data;
                    })
                    .catch(error => console.log(error));
            }
        }
    }
</script>

<style scoped>

</style>
