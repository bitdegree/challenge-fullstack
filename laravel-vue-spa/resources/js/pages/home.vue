<template>
  <div class="d-flex justify-content-center">
  <comment-section class="mb-5">

  </comment-section>
  </div>
</template>

<script>
import CommentSection from '../components/CommentSection';
import axios from 'axios';


export default {
  components: {
    CommentSection
  },
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  },
  data: function () {
    return {
      comments: [],
    }
  },

  mounted () {
    axios
      .get('api/comments')
      .then(response => (this.comments = response))
  },

  methods: {

  }
}
</script>
