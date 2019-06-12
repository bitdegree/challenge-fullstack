<template>

    <div class="container">
        <auth-card v-on:on-auth-status-changed="onAuthStatusChange"></auth-card>
        <comment-card v-bind:jwt="jwt" v-bind:user="user"></comment-card>
    </div>

</template>

<script>

    export default {
        data: function() {
            return {
                jwt: null,
                user: null
            }
        },
        methods: {
            onAuthStatusChange: function(jwt, user) {
                this.jwt = jwt;
                this.user = user;
            }
        }
    }

</script>
