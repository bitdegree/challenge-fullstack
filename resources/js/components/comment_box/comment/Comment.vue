<template>
    <article class="comment">
        <aside class="actuall-comment">
            <figure class="imgside">
                <img :src="comment.user.avatar">
            </figure>
            <div class="infoside">
                <div class="header">
                    <div class="name">{{comment.user.name}}</div>
                    <div class="date">{{comment.updated_at}}</div>
                </div>
                <div>{{comment.textField}}</div>
            </div>
        </aside>
        <button class="togglebtn" @click="toggleComments">
            Reply
        </button>
        <transition-group name="slide-fade" mode="out-in">
            <div class="list" v-show="toggle" :key="1">
                <ReplyBox :commentid="comment.id" :user="user" />
            </div>
        </transition-group>
    </article>
</template>

<script>
    import Form from "../form/Form";
    import Reply from "../reply_box/reply/Reply";
    import ReplyBox from "../reply_box/ReplyBox";
    export default {
        name: "Comment",
        components: {ReplyBox, Form},
        props: {
            comment: '',
            callReload: {
                type: Function
            },
            user: {
                default: false
            },
        },
        data(){
            return {
                toggle: false,
                replies: []
            }
        },
        methods: {
            toggleComments(){
                this.toggle = !this.toggle;
            },
        },
    }
</script>

<style lang="scss" scoped>
    @import "Comment";
</style>
