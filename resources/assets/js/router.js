import Router from 'vue-router'
import Home from './views/Home'
import Project from './views/Project'

let routes = [
  {
    name: 'home',
    path: '/',
    component: Home,
    props: true,
  },
  {
    name: 'project',
    path: '/project/:id',
    component: Project,
    props: true,
  },
]

export default new Router({
  routes,
  linkActiveClass: 'is-active',
  mode: 'history',
})
