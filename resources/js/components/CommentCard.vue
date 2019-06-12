<template>
    <div id="commentCard" class="row justify-content-center my-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comment Box!</div>

                <div class="card-body">
                    <div class="w-100">
                        <p>x Earlier Comments. <a>Load more...</a></p>
                    </div>
                    <div class="w-100 my-4">
                        <div class="w-100 row border-bottom border-top py-3">
                            <div class="col-2">
                                <img class="w-100 h-auto"
                                     src="http://i.dailymail.co.uk/i/pix/2015/09/01/18/2BE1E88B00000578-3218613-image-m-5_1441127035222.jpg"/>
                            </div>
                            <div class="col-10">
                                <p><b>Karolis Kraujelis</b> 5:12 PM</p>
                                <p>Hello World this is a very good comment which I like.</p>
                            </div>
                        </div>
                        <div class="w-100 row border-bottom py-3">
                            <div class="col-2">
                                <img class="w-100 h-auto"
                                     src="http://i.dailymail.co.uk/i/pix/2015/09/01/18/2BE1E88B00000578-3218613-image-m-5_1441127035222.jpg"/>
                            </div>
                            <div class="col-10">
                                <p><b>Karolis Kraujelis</b> 5:12 PM</p>
                                <p>Hello World this is a very good comment which I like.</p>
                            </div>
                        </div>
                        <div class="w-100 row border-bottom py-3">
                            <div class="col-2">
                                <img class="w-100 h-auto"
                                     src="http://i.dailymail.co.uk/i/pix/2015/09/01/18/2BE1E88B00000578-3218613-image-m-5_1441127035222.jpg"/>
                            </div>
                            <div class="col-10">
                                <p><b>Karolis Kraujelis</b> 5:12 PM</p>
                                <p>Hello World this is a very good comment which I like.</p>
                            </div>
                        </div>
                    </div>
                    <div v-if="this.user === null" class="w-100 text-center">
                        <p>Tik prisijungę vartotojai gali rašyti komentarą!</p>
                    </div>
                    <div v-else-if="status === 'IDLE'" class="w-100 text-center">
                        <button class="btn btn-success w-50">Post a comment</button>
                    </div>
                    <div v-else-if="status === 'POSTING'" class="w-100">
                        <input placeholder="Text"/>
                        <button class="btn btn-success">Post</button>
                        <button class="btn btn-secondary">Cancel</button>
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
                'status': "IDLE"
            }
        },
        props: [
            'jwt',
            'user'
        ]
    }

</script>
