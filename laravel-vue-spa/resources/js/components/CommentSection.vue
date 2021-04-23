<template>
  <div class="card shadow" style="width: 30rem;">
    <ul class="list-group">
      <div class="d-flex p-4">
        56 comments earlier
      </div>
      <li id="comment" v-for="comment in comments.data" class="list-group-item d-flex">
        <div class="">
          <img :src='comment.user_photo' class="rounded-circle" height="50rem">
        </div>
        <div class="pl-3 pt-2 pr-2">
          <div class="d-flex">
            <h6>{{comment.user_name}}</h6>
            <h6 class="pl-2" id="time">{{comment.created_at}}</h6>
          </div>
          <p class="text-body">{{comment.description}}</p>
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
      comments: [],
      newcomment: ''
    }
  },

  mounted () {
    axios
      .get('api/comments')
      .then(response => (this.comments = response))
  },
  methods: {
    postComment () {
      axios.post('api/comments', [newcomment]).then(alert('works'))
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
</style>
