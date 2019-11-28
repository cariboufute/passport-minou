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
                this.askMinetteWithAccessToken(relation);
            },

            askMinetteWithAccessToken(relation) {
                this.getOAuth2Tokens();

                //TODO make logic with refreshToken
            },

            getOAuth2Tokens() {
                console.log('getOAuth2Tokens');
                axios.get('/redirect').then(response => {
                    console.log(response.data);
                    //this.accessToken = response.data.accessToken;
                    //this.refreshToken = response.data.refreshToken;
                }).catch(error => console.log(error));
            },

            askMinetteWithClientToken(relation) {
                // Client Secret for Client ID 2
                const clientSecret = 'a6rSGoOUwafp0bRWzI6so7lLjcnSuOfmApCYrchm';
                const password = window.user.name.split('@')[0].toLowerCase();

                axios.post(baseUrl + 'oauth/token', {
                    'grant_type': 'password',
                    'client_id': 2,
                    'client_secret': clientSecret,
                    'username': window.user.name,
                    'password': password,
                    'scope': '*',
                }).then(response => {
                    console.log(response.data);
                })
            },

            askMinetteWithToken(relation, token) {
                axios.get(baseUrl + 'api/' + relation, {
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                })
                    .then(response => {
                        this.minetteAnswer = response.data;
                    })
                    .catch(error => console.log(error));
            }
        }
    }
</script>

<style scoped>

</style>
