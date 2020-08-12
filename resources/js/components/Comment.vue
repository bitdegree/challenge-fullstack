<template>
    <div class="flex-user-container comment-min-width">
        <div>
            <img
                :src="post['user']['avatar']"
                alt=""
                class="rounded-circle user-logo"
            />
        </div>
        <div class="ml-3 w-100">
            <div class="row ">
                <div class="col-8">
                    <span class="font-weight-bold mb-0 mr-2">{{
                        post["user"]["name"]
                    }}</span
                    >{{ post["created_at"] }}
                </div>
            </div>
            <div class="row">
                <div class="col user-comment">
                    <p>{{ post["content"] }}</p>
                </div>
            </div>
            <div class="row">
                <div class="row mb-1">
                     <button
                    type="button"
                    class="btn btn-link"
                    v-on:click="toggleReply('newPost-' + post['id'])"
                >
                    Reply
                </button>
                <button
                    type="button"
                    class="btn btn-link"
                    v-on:click="deletePost()"
                >
                    Delete
                </button>
                </div>

                <div class="row" :id="'newPost-' + post['id']" style="display: none">
                    <new-post :parent="post['id']" :id="'newPost-' + post['id']"></new-post>
                </div>
                <div v-for="child in children" class="w-100">
                    <post :post="child"></post>
                </div>
            </div>

            <div class="row" v-if="getDepth(0) > 2">
                    <button
                    :id="'route-' + post['id']"
                    type="button"
                    class="btn btn-link"
                    v-on:click="getPost(post['id'])"
                >
                    Load more comments
                </button></div>
        </div>
    </div>
</template>
<script>
import NewPost from "./NewPost";
import axios from "axios";
import $ from 'jquery';
import routes from '../routes';
export default {
    name: "post",
    components: {
        NewPost
    },
    props: ["post"],
    data: function() {
        return {
            children: [],
            isLoading: true,
        };
    },
    filters:{
        getDepth(number=0){
            if(this.$parent.getDepth){
                return this.$parent.getDepth(++number);
            }
            return 0;

        }
    },
    methods: {
        getPost(id=this.post['id']){
            this.$parent.getPost(id);
        },
        getPosts() {
            let _this = this;
            this.isLoading = true;
            this.children = [];
            axios.get("/post-children/" + this.post['id']).then(response => {
                _this.children = response.data;
                _this.isLoading = false;
            });
        },
        deletePost() {
            let _this = this;
            axios.get("/destroy/" + this.post["id"]).then(response => {
                _this.isLoading = false;
            });
        },
        toggleReply(id) {
            $("#" + id).fadeToggle("slow", function() {});
        },
        getDepth(number=0){
            if(this.$parent.getDepth){
                return this.$parent.getDepth(++number);
            }else{

            }
            return 0;

        }
    },
    mounted() {
        if(this.getDepth() < 3){
            this.getPosts();
        } else {
            let id = 'route-' + this.post['id'];
            let element = $("#" + id);
            if(element){
            element.removeClass('d-none');
            }

        }

    }
};
</script>
