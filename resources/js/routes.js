import List from './components/List.vue';
import Comment from './components/Comment.vue';
export default{
    mode: 'history',
    routes: [
        {
            path: '/',
            component: List,
            name: 'list'
        },
        {
            path: '/:id',
            component: List,
            name: 'showPost',
            props: true
        },
    ]
}
