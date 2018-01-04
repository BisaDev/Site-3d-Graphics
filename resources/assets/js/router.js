import Router from 'vue-router';

let routes = [
    {
        path: '/',
        component: require('./components/home/Home')
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
