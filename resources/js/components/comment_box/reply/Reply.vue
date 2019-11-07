<template>
    <div class="comment">
        <div class="actuall-comment">
            <div class="imgside">
<!--                <img :src="reply.user.avatar">-->
            </div>
            <div class="infoside">
<!--                <header>-->
<!--                    <div class="name">{{comment.user.name}}</div>-->
<!--                    <div class="date">{{comment.updated_at}}</div>-->
<!--                </header>-->
                <div>{{reply.textField}}</div>
                <div>{{reply}}</div>
            </div>
        </div>
    </div>
</template>

<script>
    import Form from "../form/Form";
    export default {
        name: "Reply",
        components: {Form},
        props: {
            reply: '',
            callReload: {
                type: Function
            },
            userInfo: '',
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
    @import "reply";
</style>
