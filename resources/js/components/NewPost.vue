<template>
    <div :id="'newPost-' + parent" class="container">
        <div class="new-post col justify-content-center">
            <input
                type="text"
                class="form-input"
                v-bind:class="{ error: error !== '' }"
                v-model="content"
                placeholder="Add comment..."
            />
            <div class="btn-group m-2">
                <button class="btn btn-success my-1" v-on:click="createPost">
                    Post
                </button>
                <button class="btn btn-secondary my-1" v-on:click="close">
                    Cancel
                </button>
            </div>
        </div>
        <div class="row" v-if="error !== ''">
            <small class="error-text">{{ error }}</small>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import $ from 'jquery';
export default {
    props: ["parent"],
    data: function() {
        return {
            content: "",
            isLoading: true,
            error: ""
        };
    },
    methods: {
        toggleError(message) {
            this.error = message;
        },
        createPost() {
            let _this = this;
            this.isLoading = true;
            let data = {
                content: this.content,
                parent: this.parent
            };
            axios.post("/create-post", data).then(function(response) {
                if (response.data !== 1) {
                    _this.toggleError(response.data);
                } else {
                    _this.toggleError("");
                }

                _this.isLoading = false;

                try {
                    _this.$parent.getPosts();
                } catch (e) {
                    console.log(e);
                }
                _this.content = "";
            });
        },
        close() {
                this.$parent.toggleReply('newPost-' + this.parent);
        }
    },
    mounted() {}
};
</script>
