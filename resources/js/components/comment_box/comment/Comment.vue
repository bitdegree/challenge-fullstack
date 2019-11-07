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
        <div v-if="!reply" class="togglebtn" @click="toggleComments">Reply</div>
        <div v-show="this.toggle">
            <div class="reply-box" v-if="reply===false">
                <ul class="reply-list" v-if="comment.replies.length > 0">
                    <li v-for="reply in comment.replies" :key="reply.id" >
                        <Reply :reply="reply" :userInfo="userInfo"/>
                    </li>
                </ul>
            </div>
            <Form :disabled="user" :callReload ="callReload" :reply="true" :id="comment.id"></Form>
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
                src: 'https://i.pinimg.com/originals/54/51/04/545104ed5f91a931e85f2be92048fd9f.jpg'
            }
        },
        methods: {
            toggleComments(){
                this.toggle = !this.toggle
            }
        },
    }
</script>

<style lang="scss" scoped>
    @import "comment";
</style>
