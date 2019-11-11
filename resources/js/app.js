require('./bootstrap');

import Vue from 'vue'
import VueProgressBar from 'vue-progressbar'

const options = {
    color: '#00be06',
    failedColor: '#ff2f34',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
};

Vue.use(VueProgressBar, options);

Vue.component('comment-box', require('./components/comment_box/CommentBox.vue').default);

const app = new Vue({
    el: '#app',
});

require('./facebookCheckLoginState');
require('./inputOnChangeListener');



