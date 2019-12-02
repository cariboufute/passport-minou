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
    import axios from 'axios';
    import CatCard from "./CatCard";

    const baseUrl = 'http://minette.test/';

    export default {
        components: { CatCard },

        data() {
            return {
                minetteAnswer: '',
                accessToken: null,
                refreshToken: null
            }
        },

        methods: {
            askMinette(relation) {
                //this.askMinetteWithClientToken(relation);
                //this.askMinetteWithAccessToken(relation);
                this.askMinetteWithPersonalAccessToken(relation);
            },

            askMinetteWithAccessToken(relation) {
                this.getOAuth2Tokens().then(() => {
                    this.askMinetteWithToken(relation, this.accessToken);
                });

                //TODO make logic with refreshToken
            },

            getOAuth2Tokens() {
                return axios.get('/redirect')
                    .then(response => {
                        this.accessToken = response.data.accessToken;
                        this.refreshToken = response.data.refreshToken;
                    })
                    .catch(error => console.log(error));
            },

            askMinetteWithClientToken(relation) {
                const password = window.user.name.split('@')[0].toLowerCase();

                axios.get('/password-token', {
                    params: {
                        'username': window.user.name,
                        'password': password,
                    }
                }).then(response => {
                    this.accessToken = response.data.accessToken;
                    this.refreshToken = response.data.refreshToken;

                    this.askMinetteWithToken(relation, this.accessToken);
                })
            },

            askMinetteWithPersonalAccessToken(relation) {
                axios.get('/' + relation)
                    .then(response => {
                        this.minetteAnswer = response.data;
                    })
                    .catch(error => console.log(error));

                /*axios.get(baseUrl + 'api/' + relation, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                    .then(response => {
                        this.minetteAnswer = response.data;
                    })
                    .catch(error => console.log(error));*/
            }
        }
    }
</script>

<style scoped>

</style>
