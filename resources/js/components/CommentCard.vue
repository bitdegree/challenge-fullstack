<template>
    <div id="commentCard" class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comment Box!</div>

                <div class="card-body">
                    <div class="w-100">
                        <p class="my-2">69 Earlier Comments. <a href="#">Load more...</a></p>
                    </div>
                    <div class="w-100 mb-4">
                        <div class="w-100 row border-bottom border-top py-3">
                            <div class="col-2">
                                <img class="w-100 h-auto"
                                     src="http://i.dailymail.co.uk/i/pix/2015/09/01/18/2BE1E88B00000578-3218613-image-m-5_1441127035222.jpg"/>
                            </div>
                            <div class="col-10">
                                <p class="text-muted"><b class="mr-4">Karolis Kraujelis</b> 5:12 PM</p>
                                <p>Hello World this is a very good comment which I like.</p>
                            </div>
                        </div>
                        <div class="w-100 row border-bottom py-3">
                            <div class="col-2">
                                <img class="w-100 h-auto"
                                     src="http://i.dailymail.co.uk/i/pix/2015/09/01/18/2BE1E88B00000578-3218613-image-m-5_1441127035222.jpg"/>
                            </div>
                            <div class="col-10">
                                <p class="text-muted"><b class="mr-4">Karolis Kraujelis</b> 5:12 PM</p>
                                <p>Hello World this is a very good comment which I like.</p>
                            </div>
                        </div>
                        <div class="w-100 row border-bottom py-3">
                            <div class="col-2">
                                <img class="w-100 h-auto"
                                     src="http://i.dailymail.co.uk/i/pix/2015/09/01/18/2BE1E88B00000578-3218613-image-m-5_1441127035222.jpg"/>
                            </div>
                            <div class="col-10">
                                <p class="text-muted"><b class="mr-4">Karolis Kraujelis</b> 5:12 PM</p>
                                <p>Hello World this is a very good comment which I like.</p>
                            </div>
                        </div>
                    </div>
                    <div v-if="this.user === null" class="w-100 text-center">
                        <p>Tik prisijungę vartotojai gali rašyti komentarą!</p>
                    </div>
                    <div v-else-if="status === 'IDLE'" class="w-100 text-center">
                        <button class="btn btn-success w-50" v-on:click="switchToPosting">Post a comment</button>
                    </div>
                    <div v-else-if="status === 'POSTING'" class="w-100">
                        <div class="text-center">
                            <div v-if="postData.error !== null" class="alert alert-danger">
                                <p>{{postData.error}}</p>
                            </div>
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
                comments: []
            }
        },
        props: [
            'jwt',
            'user'
        ],
        methods: {
            switchToPosting: function () {
                this.status = "POSTING";
            },
            switchToIdle: function () {
                this.status = "IDLE";
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

                            this.comments.push(json);
                        }
                    }
                )

            }
        }
    }


</script>
