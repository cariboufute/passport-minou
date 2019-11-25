<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <img class="img-thumbnail cat-thumbnail"
                             :src="image"
                             :alt="username"
                        />

                        {{ username }}
                    </div>

                    <div class="card-body">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            username: String,
            image: String
        }
    }
</script>

<style scoped>
    .cat-thumbnail {
        width: 100px;
        height: 100px;
    }
</style>
