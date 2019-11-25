<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <img class="img-thumbnail cat-thumbnail"
                             :src="userImage"
                             :alt="user.name"
                        />

                        {{ user.name }}
                    </div>

                    <div class="card-body">
                        Que voulez-vous proposer à Minette&#8239;?
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "UserCatRequest",

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

<style scoped>
    .cat-thumbnail {
        width: 100px;
        height: 100px;
    }
</style>
