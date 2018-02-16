import Router from 'vue-router'
import Home from './views/Home'
import Project from './views/Project'
import Work from './views/Work'
import Studio from './views/Studio'
import Contact from './views/Contact'
import NotFound from './views/NotFound'

let routes = [
  {
    name: 'home',
    path: '/',
    component: Home,
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
  },
  {
    name: 'studio',
    path: '/studio',
    component: Studio,
  },
  {
    name: 'contact',
    path: '/contact',
    component: Contact,
  },
  {
    name: '404',
    path: '/notFound',
    component: NotFound,
  },
]

function scrollBehavior(to, from, savedPosition) {
  if (to.hash) {
    return {
      selector: to.hash,
    }
  } else if (savedPosition) {
    return savedPosition
  } else {
    return { x: 0, y: 0 }
  }
}

const router = new Router({
  routes,
  scrollBehavior,
  linkActiveClass: 'is-active',
  mode: 'history',
})

router.beforeEach((to, from, next) => {
    if (!to.matched.length) {
        next('/notFound');
    } else {
        next();
    }
});

export default router