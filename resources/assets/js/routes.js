import Router from 'vue-router';

let routes = [{
    path: '/',
    component: require('./views/Home')
  },
  {
    name: 'project',
    path: '/project/:id',
    component: require('./views/Project'),
    props: true
  }

]

let router = new Router({
  routes,
  linkActiveClass: 'is-active',
  mode: 'history'
})


export default router