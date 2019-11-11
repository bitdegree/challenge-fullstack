<template>
    <div class="comment-box">
        <vue-progress-bar></vue-progress-bar>
        <div @click="changeLimit" class="earlear-comments">{{earlierComments}}</div>
        <ul class="comment-list">
            <li v-for="comment in comments.slice(0, limit)" :key="comment.id">
                <Comment :user="!user" :callReload = getAllItems :comment="comment"></Comment>
            </li>
        </ul>
        <Form :routename="routename" :disabled="!user" :callReload = getAllItems></Form>
    </div>
</template>
<script>

    import Form from "./form/Form";
    import Comment from "./comment/Comment";
    export default {
        props: {
            user: {
                default: false
            },
            routename: {
                default: 'home'
            },
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
            earlierComments(){
                return (
                    this.comments.length-this.limit > 1 ? this.comments.length-this.limit + " earlier comments": ''
                )
            }
        },
        mounted() {
            this.getAllItems();
        },
        methods: {
            getAllItems() {
                this.$Progress.start();
                axios
                    .get('/comments/' + this.routename)
                    .then(response => {
                        this.comments = response.data.comments;
                        this.$Progress.finish();
                    }).catch(error => {
                    console.log(error)
                    })
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
