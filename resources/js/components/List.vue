<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-display container-bg mb-5">
                    <button type="button" class="btn btn-primary" v-if="onePost" v-on:click="getPosts()">&lt;</button>
                    <div class="card-body" v-if="!isLoading">
                        <div class="mb-5" v-if="count > 0"><button type="button" class="btn btn-link" v-on:click="getPosts(true)">{{count}} earlier comments</button></div>
                        <div class="mb-5" v-for="post in posts">
                            <comment :post="post"></comment>
                        </div>
                        <button
                        v-if="!onePost"
                            type="button"
                            class="btn btn-success btn-lg btn-block mx-2"
                            v-on:click="toggleReply('main')"
                        >
                            Add a comment
                        </button>
                        <new-post
                            id="main"
                            :parent="'none'"
                            style="display: none"
                            class="mt-2"
                        />
                    </div>
                    <div class="spinner-border mx-auto my-5" v-else>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NewPost from "./NewPost";
import Comment from "./Comment";
import axios from "axios";
import $ from "jquery";
export default {
    components: {
        Comment,
        NewPost
    },
    props: ["parent"],
    data: function() {
        return {
            id: -1,
            posts: [],
            isLoading: true,
            count: 0,
            onePost: false,
            allPosts: false,
        };
    },
    methods: {
        getPost(id){
            let _this = this;
            this.isLoading = true;
            this.posts = [];
            this.onePost = true;
            axios.get("/post/" + id).then(response => {
                _this.posts = response.data.posts;
                _this.count = response.data.count;
                _this.isLoading = false;
            });
        },
        getPosts(allPosts = false) {
            let _this = this;
            this.isLoading = true;
            this.posts = [];
            this.onePost = false;

            axios.get("/post-list/" + allPosts).then(response => {
                _this.posts = response.data.posts;
                _this.count = response.data.count;
                _this.isLoading = false;
            });
        },

        toggleReply(id) {
            $("#" + id).fadeToggle("slow", function() {});
        },
        getDepth(number){
            return number;
        }
    },
    mounted() {
        this.getPosts();
    }
};
</script>
