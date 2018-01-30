import Router from 'vue-router';

let routes = [
    {
        name: 'home',
        path: '/',
        component: require('./views/Home'),
        props: true
    },
    {
        name: 'project',
        path: '/project/:id',
        component: require('./views/Project'),
        props: true
    }
];

export default new Router({
    routes,
    linkActiveClass: 'is-active',
    mode: 'history'
});