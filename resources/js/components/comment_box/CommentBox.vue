<template>
    <div class="comment-box">
        <ul class="comment-list">
            <li v-for="comment in comments" :key="comment.id">
                <Comment :comment="comment"></Comment>
<!--                <ul class="reply-list" v-if="comment.replies">-->
<!--                    <li v-for="reply in comment.replies" :key="reply.id" >-->
<!--                        <Comment :reply="true"></Comment>-->
<!--                    </li>-->
<!--                </ul>-->
            </li>
        </ul>
        <Form></Form>
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
