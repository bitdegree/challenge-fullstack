require('./bootstrap');

window.Vue = require('vue');

Vue.component('comment-box', require('./components/comment_box/CommentBox.vue').default);

const app = new Vue({
    el: '#app',
});

require('./facebookCheckLoginState');
require('./inputOnChangeListener');

