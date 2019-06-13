<template>
    <div id="commentCard" class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comment Box!</div>

                <div class="card-body">
                    <div class="w-100">
                        <p class="my-2">{{comments.length}} comments.<a class="ml-3" v-if="backEnabled" href="#"
                                                                        v-on:click="goBack">Return...</a></p>
                    </div>
                    <div v-if="comments.length === 0" class="w-100 text-center border-bottom border-top">
                        <h5 class="text-muted my-5">No comments were found!</h5>
                    </div>
                    <div class="w-100 mb-4 custom-list">
                        <div v-for="comment in comments" class="w-100 row border-bottom border-top py-3">
                            <div class="col-2">
                                <img class="w-100 h-auto rounded-circle"
                                     v-bind:src="comment.avatarURL"/>
                            </div>
                            <div class="col-10">
                                <p class="text-muted"><b class="mr-4">{{comment.firstName}} {{comment.lastName}}</b>
                                    {{comment.created_at}}</p>
                                <p>{{comment.content}}</p>
                                <div v-if="!backEnabled">
                                    <hr>

                                    <button v-if="comment.num_replies === 0" class="btn btn-success" disabled>View 0
                                        replies
                                    </button>
                                    <button v-else class="btn btn-success" v-on:click="viewReplies(comment.id)">View
                                        {{comment.num_replies}} replies
                                    </button>

                                    <button v-if="user === null" class="btn btn-success" disabled>Reply</button>
                                    <button v-else class="btn btn-success" v-on:click="switchToPosting(comment)">Reply
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div v-if="user === null" class="w-100 text-center">
                        <p>Only authenticated users are able to write replies!</p>
                    </div>
                    <div v-else-if="status === 'IDLE'" class="w-100 text-center">
                        <button v-if="!backEnabled" class="btn btn-success w-50" v-on:click="switchToPosting()">Post a
                            comment
                        </button>
                        <button v-else class="btn btn-success w-50" v-on:click="switchToPosting(comments[0])">Reply to
                            {{comments[0].firstName}} {{comments[0].lastName}} comment
                        </button>
                    </div>
                    <div v-else-if="status === 'POSTING'" class="w-100">
                        <div class="text-center">
                            <div v-if="postData.error !== null" class="alert alert-danger">
                                <p>{{postData.error}}</p>
                            </div>
                        </div>
                        <div v-if="postData.parent !== null" class="w-100">
                            <p>Replying to {{postData.parent.firstName}} {{postData.parent.lastName}} post...</p>
                        </div>
                        <input placeholder="Your comment..." v-model="postData.text" class="w-100 d-inline-block"/><br/>
                        <button class="btn btn-success mt-3 mr-2 px-5" v-on:click="postComment">Post</button>
                        <button class="btn btn-secondary mt-3 mx-2 px-5" v-on:click="switchToIdle">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        data: function () {
            return {
                status: "IDLE",
                postData: {
                    error: null,
                    parent: null,
                    text: null,
                },
                comments: [],
                parentComment: null,
                backEnabled: false
            }
        },
        props: [
            'jwt',
            'user'
        ],
        mounted() {
            this.fetchComments();
        },
        methods: {
            goBack: function (event) {
                event.preventDefault();

                this.fetchComments();
            },
            switchToPosting: function (parent = null) {
                this.status = "POSTING";
                this.postData.parent = parent;

                console.log(this.postData.parent);
            },
            viewReplies: function (parent) {
                this.comments = [];

                fetch(
                    `${location.protocol}//${location.host}/api/comments/${parent}`,
                    {
                        method: "GET"
                    }
                ).then(
                    (response) => {
                        return response.json();
                    }
                ).then(
                    (json) => {
                        this.comments = json;
                        this.backEnabled = true;
                    }
                )
            },
            switchToIdle: function () {
                this.status = "IDLE";
            },
            fetchComments: function () {
                this.comments = [];

                fetch(
                    `${location.protocol}//${location.host}/api/comments`,
                    {
                        method: "GET"
                    }
                ).then(
                    (response) => {
                        return response.json();
                    }
                ).then(
                    (json) => {
                        this.comments = json;
                        this.backEnabled = false;
                    }
                )
            },
            postComment: function () {
                fetch(`${location.protocol}//${location.host}/api/comments`, {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify(
                        {
                            token: this.jwt,
                            content: this.postData.text,
                            parent: this.postData.parent === null ? null : this.postData.parent.id
                        }
                    )
                }).then(
                    (response) => {
                        return response.json();
                    }
                ).then(
                    (json) => {
                        if (json.message !== undefined)
                            this.postData.error = json.message;

                        else {
                            this.status = "IDLE";

                            this.postData.error = null;
                            this.postData.parent = null;
                            this.postData.text = null;

                            if (this.backEnabled)
                                this.viewReplies(
                                    this.comments[0].id
                                );

                            else this.fetchComments();
                        }
                    }
                )

            }
        }
    }


</script>
