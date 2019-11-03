
require('./bootstrap');

window.Vue = require('vue');

Vue.component('comment-box', require('./components/comment_box/CommentBox.vue').default);

const app = new Vue({
    el: '#app',
});

$('.custom-file-input').on('change', function() {
    let fileName = $(this).val().split('\\').pop();
    $(this).next('.custom-file-label').addClass("selected").html(fileName);
});
