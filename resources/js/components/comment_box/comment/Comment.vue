<template>
    <div class="comment">
        <div>
            {{comment.textField}}
            <div v-if="!reply" class="toggleBtn" @click="toggleComments">Reply</div>
        </div>
        <div v-show="this.toggle">
            <div class="reply-box" v-if="reply===false">
                <ul class="reply-list" v-if="comment.replies.length > 0">
                    <li v-for="reply in comment.replies" :key="reply.id" >
                        <Comment :comment="reply" :reply="true"></Comment>
                    </li>
                </ul>
            </div>
            <Form :callReload ="callReload" :reply="true" :id="comment.id"></Form>
        </div>

    </div>
</template>

<script>
    import Form from "../form/Form";
    export default {
        name: "Comment",
        components: {Form},
        props: {
            comment: '',
            reply: {
                default: false,
                type: Boolean,
            },
            callReload: {
                type: Function
            },
        },
        data(){
            return {
                toggle: false
            }
        },
        methods: {
            toggleComments(){
                this.toggle = !this.toggle
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "comment";
</style>
