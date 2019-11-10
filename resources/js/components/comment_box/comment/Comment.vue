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
        <div class="togglebtn" @click="toggleComments">Reply</div>
        <transition-group name="slide-fade" mode="out-in">
            <div class="list" v-show="toggle" :key="1">
                <ReplyBox :commentid="comment.id" :user="user" />
            </div>
        </transition-group>
    </div>
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
    @import "comment";
</style>
