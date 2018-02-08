import Router from 'vue-router'
import Home from './views/Home'
import Project from './views/Project'
import Work from './views/Work'
import Studio from './views/Studio'
import Contact from './views/Contact'

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
  {
    name: 'work',
    path: '/work',
    component: Work,
    props: true,
  },
  {
    name: 'studio',
    path: '/studio',
    component: Studio,
    props: true,
  },
  {
    name: 'contact',
    path: '/contact',
    component: Contact,
    props: true,
  },
]

export default new Router({
  routes,
  linkActiveClass: 'is-active',
  mode: 'history',
})
