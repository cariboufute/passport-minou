<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <passport-clients></passport-clients>
                <passport-authorized-clients></passport-authorized-clients>
                <passport-personal-access-tokens></passport-personal-access-tokens>
            </div>
        </div>
    </div>
</template>

<script>
    import PassportClients from './passport/Clients';
    import PassportAuthorizedClients from './passport/AuthorizedClients';
    import PassportPersonalAccessTokens from './passport/PersonalAccessTokens';

    export default {
        name: "PassportApp",
        components: {
            PassportClients,
            PassportAuthorizedClients,
            PassportPersonalAccessTokens
        }
    }
</script>
