<template>
    <div class="comment-box">
        <div @click="changeLimit" class="earlear-comments">{{comments.length-limit > 1 ? comments.length-limit + " earlier comments": ''}}</div>
        <ul class="comment-list">
            <li v-for="comment in comments.slice(0, limit)" :key="comment.id">
                <Comment :user="!user" :callReload = getAllItems :comment="comment"></Comment>
            </li>
        </ul>
        <Form :disabled="!user" :callReload = getAllItems></Form>
    </div>
</template>
<script>

    import Form from "./form/Form";
    import Comment from "./comment/Comment";
    export default {
        props: {
            user: {
                default: false
            }
        },
        name: 'commentbox',
        components: {Form, Comment},
        data() {
            return {
                comments: [],
                limit: 4
            }
        },
        computed:{
            computedObj(){
                return this.limit ? this.comments.slice(0,this.limit) : this.comments
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
            changeLimit(){
                this.limit +=5;
                this.getAllItems();
            }
        }

    }
</script>
<style lang="scss" scoped>
    @import "commentBox";
</style>
