<template>
  <div class="card shadow overflow-auto" style="width: 30rem;">
    <div class="d-flex p-4" v-if="commentsleft != 0" >
      <span id="commentsleft" @click="numberofcomments += 5">{{commentsleft}} comments earlier</span>
    </div>
    <ul class="list-group border-0 overflow-auto">
      <li id="comment" v-for="comment in currentcomments" :key="comment" class="list-group-item d-flex">
        <div class="col-2">
          <img :src='comment.user_photo' class="rounded-circle" height="50rem">
        </div>
        <div class="pl-3 pt-2 pr-2 col-9">
          <div class="d-flex">
            <h6>{{comment.user_name}}</h6>
            <h6 class="pl-2" id="time">{{comment.created_at}}</h6>
          </div>
          <p class="text-body">{{comment.description}}</p>
        </div>
        <div v-if="comment.current_user" @click="deleteComment(comment.id)" id="delete">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="#bbbbbb" height="25px" class="mt-4" >
          <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
        </svg>
        </div>
      </li>
    </ul>
    <div class="card-body">
      <form @submit.prevent="postComment">
        <div class="form-group">
          <input required id="addcomment" type="text" class="form-control p-2 mb-3" placeholder="Add a comment" v-model="newcomment">
          <button type="submit" class="btn btn-success d-inline">Post</button>
          <button type="button" class="btn btn-toolbar d-inline" @click="newcomment = ''">Cancel</button>
        </div>
      </form>
    </div>
  </div>

</template>

<script>
import axios from 'axios'

export default {
  name: 'CommentSection',

  data: function () {
    return {
      numberofcomments: 5,
      commentsleft: 0,
      currentcomments: [],
      comments: [],
      newcomment: ''
    }
  },

  mounted () {
    this.updateCurrentComments()
  },
  methods: {
    postComment () {
      axios.post('api/comments', {
        comment: this.newcomment
      })
        .then(() => {
          this.updateCurrentComments()
          this.newcomment = ''
        })
        .catch(function (error) {
          console.log(error)
        })
    },
    async updateCommnents () {
      await axios
        .get('api/comments')
        .then(response => (this.comments = response))
        .catch()
    },
    //  Takes a slices of all the comments
    async updateCurrentComments () {
      await this.updateCommnents()
      this.currentcomments = this.comments.data.slice((this.comments.data.length - this.numberofcomments) >= 0 ? (this.comments.data.length - this.numberofcomments) : 0, this.comments.data.length)
      this.commentsleft = this.comments.data.length - this.currentcomments.length
    },
    deleteComment (id) {
      confirm('Are you sure?')
      axios
        .delete('api/comments/' + id)
        .then(() => this.updateCurrentComments())
        .catch()
    }
  },
  watch: {
    numberofcomments: function () {
      this.currentcomments = this.comments.data.slice((this.comments.data.length - this.numberofcomments) >= 0 ? (this.comments.data.length - this.numberofcomments) : 0, this.comments.data.length)
      this.commentsleft = this.comments.data.length - this.currentcomments.length
    }
  }
}
</script>

<style scoped>
#comment{
  border-style: none;
}
#time{
  font-weight: normal;
  color: gray;
}
.card{
  border-radius: 10px;
  box-shadow: #1b1e21;
}
#addcomment{
  border-style: none;
  border-bottom: 2px solid #a5a5a5;
}
ul{
  max-height: 35rem;
}

#commentsleft{
  cursor: pointer;
}
#delete{
  cursor: pointer;
}
</style>
