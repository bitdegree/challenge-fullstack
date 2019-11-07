<template>
    <div class="comment">
        <div class="actuall-comment">
            <div class="imgside">
                <img :src="reply.user.avatar">
            </div>
            <div class="infoside">
                <header>
                    <div class="name">{{reply.user.name}}</div>
                    <div class="date">{{reply.updated_at}}</div>
                </header>
                <div>{{reply.textField}}</div>
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
