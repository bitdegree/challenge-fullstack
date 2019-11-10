<template>
    <div class="reply-box">
        <ul class="reply-list" v-if="replies.length > 0">
            <li v-for="reply in replies" :key="reply.id" >
                <Reply :reply="reply"/>
            </li>
        </ul>
        <Form class="ml-5" :disabled="user" :callReload =getAllReplies :reply="true" :id="commentid"></Form>
    </div>
</template>

<script>
    import Form from "../form/Form";
    import Reply from "./reply/Reply";
    export default {
        name: "ReplyBox",
        components: {Reply, Form},
        props: ['user', 'commentid'],
        data(){
            return{
                replies: []
            }
        },
        mounted(){
            this.getAllReplies(this.commentid);
        },
        methods: {
            getAllReplies($id) {
                axios.get('/replies/'+$id)
                    .then(response => {
                        this.replies = response.data.replies;
                    });
            },
        }
    }
</script>

<style lang="scss" scoped>
    @import "replyBox";
</style>
