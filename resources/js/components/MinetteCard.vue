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
                this.askMinetteWithClientToken(relation);
                //this.askMinetteWithAccessToken(relation);
            },

            askMinetteWithAccessToken(relation) {
                this.askMinetteWithToken(relation,
                    "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI3IiwianRpIjoiNzkxNTk0ZDI2NDM2MTZiMDJhYWUwM2FjY2QwNTI0YzJjN2Y4NjNjNGZkZmVmOWMwZTRmMWUwZWVlMDM4MzQ0Yzc4ZjhiZmM4M2RkMzI4ZDUiLCJpYXQiOjE1NzQ5MTMxODAsIm5iZiI6MTU3NDkxMzE4MCwiZXhwIjoxNjA2NTM1NTgwLCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.uHU56CRkv3SLXRKxwG9cKgFnWag_mNoFuAawvnf8Rbx4Q8BlyUmqcTP7KKMdMmoBNE2Xf9DhvMjfrOhE6Xbi5fr3sAWidCVX7Z9pjbBrd_yQgmP5G6nqcR-NaIsSZhLgT0ZAU_V_L6hHyaE4JTLy5ewhjEWOXvU9yhz2utHn3rMwm2AYI2xtslYbNsMaaGj2JvxZ8hoT_sTwJAN8rwPvGIQ0B97WjYhTnG87hzFEjK_9w0c4aMiwTg56mUtDmFc3uondHDS6ONy6iH_8Pc1cfa3EhVOk7xhJZW-lnYWecqu6hJhQuFZLVcgpJ8_qPF1oQhqs-YZGLKR70SUmaRaLMj9h92X82Eakfz7EN0o4VpiKFo3jBESlCazmaHqy5rQhE84M1DsdLF7h-R5LEK9nxAPjXgQeaXzEZveZpniKgF3_NRIPtlz6VdAZMw_ho8vjS8n84IgWsNRJfASf6xzQx_iou5ZSKMu9bN_sBxTU4jDrUv2EzyPGY0-0usm0NFgo6I6MYw7ZZqnr-iCXaytSXHaKNYk_T10XXFAA84NSFWkkvqZi4otpbcesRBezn1MetecWxq7OIcVSmZF4YuTWP-8_M4mHYnAU29T08MsU-VukJ7ADWL80nEn3j-lJwlOm5RQTSceKv2n2q8YAllife2H7PSb9G5J_wm8xLVURj5g");
                //this.getOAuth2Tokens();

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
                const password = window.user.name.split('@')[0].toLowerCase();

                axios.get('/password-token', {
                    params: {
                        'username': window.user.name,
                        'password': password,
                    }
                }).then(response => {
                    console.log(response.data);
                    this.accessToken = response.data.accessToken;
                    this.refreshToken = response.data.refreshToken;

                    this.askMinetteWithToken(relation, this.accessToken);
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
