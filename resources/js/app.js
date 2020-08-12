import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import axios from 'axios';

Vue.use(VueRouter)


const app = new Vue({
    el: '#app',
    router: new VueRouter(routes),
    data: function(){
        return {
            errors: []
        }
    }
});
