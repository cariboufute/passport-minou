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
    import personalToken from './.personal-token.js';

    const baseUrl = 'http://minette.test/';

    export default {
        components: { CatCard },

        data() {
            return {
                minetteAnswer: '',
            }
        },

        methods: {
            askMinette(relation) {
                //this.askMinetteWithClientToken(relation);
                this.askMinetteWithPersonalToken(relation);
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

            askMinetteWithPersonalToken(relation) {
                axios.get(baseUrl + 'api/' + relation, {
                    headers: {
                        'Authorization': 'Bearer ' + personalToken
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
