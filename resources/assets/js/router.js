import Router from 'vue-router';

let routes = [
    {
        name: 'home',
        path: '/',
        component: require('./components/home/Home'),
        props: true
    },
    {
        name: 'project',
        path: '/project/:id',
        component: require('./components/projects/Project'),
        props: true
    }
];

export default new Router({
    routes,
    linkActiveClass: 'is-active',
    mode: 'history'
});