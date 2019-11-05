<template>
    <div class="comment-box">
        <Form :callReload = getAllItems></Form>
        <ul class="comment-list">
            <li v-for="comment in comments" :key="comment.id">
                <Comment :callReload = getAllItems :comment="comment"></Comment>
            </li>
        </ul>
    </div>
</template>
<script>

    import Form from "./form/Form";
    import Comment from "./comment/Comment";
    export default {
        props: ['user' ],
        name: 'commentbox',
        components: {Form, Comment},
        data() {
            return {
                comments: []
            }
        },

        mounted() {
            this.getAllItems();
        },

        methods: {
            getAllItems() {
                axios.get('/comments')
                    .then(response => {
                        this.comments = response.data.comments;
                    });
            },
        }

    }
</script>
<style lang="scss" scoped>
    @import "commentBox";
</style>
