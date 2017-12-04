import Router from 'vue-router';

let routes = [{
    path: '/',
    component: require('./views/Home')
  },
  {
    name: 'project',
    path: '/project',
    component: require('./views/Project')
  }

]

let router = new Router({
  routes,
  linkActiveClass: 'is-active',
  mode: 'history'
})


export default router