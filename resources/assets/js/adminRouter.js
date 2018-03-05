import Router from 'vue-router'
import Dashboard from './views/admin/Dashboard'
import ProjectForm from './views/admin/ProjectsForm'
import Login from './views/admin/Login'
import Logout from './views/admin/Logout'

let routes = [
  {
    name: 'admin',
    path: '/admin',
    component: Dashboard,
    props: true,
  },
  {
    name: 'projects',
    path: '/admin/projects',
    component: ProjectForm,
    props: true,
    children: [
      {
        name: 'edit-project',
        path: ':id/edit',
        component: ProjectForm,
        props: true,
      },
      {
        name: 'create-project',
        path: 'create',
        component: ProjectForm,
        props: false,
      },
    ],
  },
  {
    name: 'login',
    path: '/login',
    component: Login,
    props: false,
  },
  {
    name: 'logout',
    path: '/logout',
    component: Logout,
    props: false,
  },
]

/**
 *
 * @param to
 * @param from
 * @param savedPosition
 * @returns {*}
 */
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

/**
 *
 * @type {VueRouter}
 */
const adminRouter = new Router({
  routes,
  scrollBehavior,
  linkActiveClass: 'is-active',
  mode: 'history',
})

adminRouter.beforeEach((to, from, next) => {
  adminRouter.app.$nextTick().then(result => {
    if (result.$root.ready) {
      if (!result.credentials && 'login' !== to.name) {
        next({ name: 'login' })
      } else {
        if ('login' === to.name && result.credentials) {
          next({ name: 'admin' })
        }

        next()
      }
    }
  })
})

adminRouter.afterEach((to, from) => {
    adminRouter.app.$nextTick().then(result => {
      console.log('afterEach');
        if (to.name === 'create-project') {
            //document.querySelector('form').reset();
        }
    })
})

export default adminRouter
