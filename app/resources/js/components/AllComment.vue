<template>
        <div class="container">
            <div class='row shadow p-3 bg-body m-2 rounded'>
                <div class="col-sm-12">
                    <p class="font-weight-bold pointer" @click="showAllComments">{{ commentCount }} earlier comments</p>
                    <div v-for="comment in comments" :key="comment.id">
                        <h5>{{ comment.name }} - <span>{{ date(comment.created_at) }}</span></h5>
                        <p>{{ comment.comment }}</p>
                    </div>
                    <form @submit.prevent="addComment">
                        <input id='name-input' type="text" class="form-control shadow-sm p-2 mb-1 bg-body rounded custom-width" placeholder="name" v-model="comment.name">
                        <input id='comment-input' type="text" class="form-control shadow-sm p-2 mb-1 bg-body rounded" placeholder="comment" v-model="comment.comment">
                        <button type='submit' class="btn btn-primary">Post</button>
                    </form>
                </div>
            </div>
        </div>
</template>
 
<script>
    export default {
        data() {
            return {
                comments: [],
                comment: {},
                commentCount: 0
            }
        },
        created() {
            this.getData(4);
        },
        methods: {
            date(date) {
                const newDate = new Date(date);
                const year = newDate.getFullYear();
                const month = newDate.getMonth();
                const day = newDate.getDate();
                const hour = newDate.getHours();
                const minute = newDate.getMinutes();
                const string = 
                    String(year) +
                    ' ' + (String(month).length === 1 ? '0' + String(month) : String(month)) +
                    ' ' + (String(day).length === 1 ? '0' + String(day) : String(day)) +
                    ' ' + (String(hour).length === 1 ? '0' + String(hour) : String(hour)) +
                    ':' + (String(minute).length === 1 ? '0' + String(minute) : String(minute));
                return string;
            },
            addComment() {
                if (!this.comment.name || !this.comment.comment) return
                this.axios
                    .post('http://localhost:8000/api/comments', this.comment)
                    .then(response => {
                        this.getData(4)
                        this.comment.name = ''
                        this.comment.comment = ''
                    })
                    .catch(err => console.log(err))
            },
            getData(amount) {
                this.axios
                    .get('http://localhost:8000/api/comments/')
                    .then(response => {
                        if (typeof amount === 'number') {
                            this.commentCount = response.data.length - amount;
                            response.data.length = amount;
                            this.comments = response.data.reverse();
                        } else if (amount === 'all') {
                            this.comments = response.data.reverse();
                        }
                });
            },
            showAllComments() {
                this.getData('all');
            }
        }
    }
</script>

<style scoped>
span {
    font-size: 11px;
    color: grey;
}
.custom-width {
    max-width: 200px;
}
.pointer {
    cursor: pointer;
}
.comments {
    width: 100%;
}
</style>