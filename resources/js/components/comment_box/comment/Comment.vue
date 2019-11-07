<template>
    <div class="comment">
        <div class="actuall-comment">
            <div class="imgside">
                <img :src="comment.user.avatar">
            </div>
            <div class="infoside">
                <header>
                    <div class="name">{{comment.user.name}}</div>
                    <div class="date">{{comment.updated_at}}</div>
                </header>
                <div>{{comment.textField}}</div>
            </div>
        </div>
        <div class="togglebtn" @click="toggleComments(comment.id)">Reply</div>
        <div v-show="this.toggle">
            <div class="reply-box">
                <ul class="reply-list" v-if="replies.length > 0">
                    <li v-for="reply in replies" :key="reply.id" >
                        <Reply :reply="reply"/>
                    </li>
                </ul>
                <Form :disabled="user" :callReload ="getAllReplies(comment.id)" :reply="true" :id="comment.id"></Form>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "../form/Form";
    import Reply from "../reply/Reply";
    export default {
        name: "Comment",
        components: {Reply, Form},
        props: {
            comment: '',
            reply: {
                default: false,
                type: Boolean,
            },
            callReload: {
                type: Function
            },
            user: {
                default: false
            },
            userInfo: ''
        },
        data(){
            return {
                toggle: false,
                replies: []
            }
        },
        methods: {
            toggleComments($id){
                this.toggle = !this.toggle;
                this.getAllReplies($id);
            },
            getAllReplies($id) {
                axios.get('/replies/'+$id)
                    .then(response => {
                        this.replies = response.data.replies;
                    });
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "comment";
</style>
