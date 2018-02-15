import Router from 'vue-router'
import Dashboard from './views/admin/Dashboard.vue'
import ProjectForm from './views/admin/ProjectsForm.vue'
import Login from './views/admin/Login.vue'
import Logout from './views/admin/Logout.vue'
//import { cookies } from './utils/utilities'

let routes = [
  {
    name: 'admin',
    path: '/admin',
    component: Dashboard,
    props: false,
      /*
    children: [
      {
        // UserProfile will be rendered inside User's <router-view>
        // when /user/:id/profile is matched
        //name: 'projects',
        path: 'projects',
        component: ProjectForm
      },
    ]
    */
  },
  {
    name: 'projects',
    path: '/admin/projects',
    component: ProjectForm,
    props: false,
    children: [
        {
            // UserProfile will be rendered inside User's <router-view>
            // when /user/:id/profile is matched
            //name: 'projects',
            path: ':id/edit',
            component: ProjectForm
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
];

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
});

adminRouter.beforeEach((to, from, next) => {
  adminRouter.app.$nextTick().then(result => {
    if (result.$root.ready) {
        if (!result.credentials && 'login' !== to.name) {
            next({name: 'login'})
        } else {
          if ('login' === to.name && result.credentials) {
            next({name: 'admin'});
          }

          next()
        }
    }
  });
});

export default adminRouter;