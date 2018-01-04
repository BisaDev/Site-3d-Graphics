import Router from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./views/Home')
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
