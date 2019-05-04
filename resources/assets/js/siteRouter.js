import Router from 'vue-router'
import Home from './views/Home'
import Project from './views/Project'
import Work from './views/Work'
import Studio from './views/Studio'
import Contact from './views/Contact'
import Recruitment from './views/Recruitment'
import ApplyForm from './views/ApplyForm'
import NotFound from './views/NotFound'
import Thanks from './views/Thanks.vue'
import BlogPost from './views/blogPost.vue'

let routes = [
    {
        name: 'home',
        path: '/',
        component: Home,
        props: true,
    },
    {
        name: 'project',
        path: '/project/:slug',
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
    {
        name: 'news',
        path: '/news',
        component: BlogPost,
        props: true,
    },
    {
        name: 'recruitment',
        path: '/recruitment',
        component: Recruitment,
        props: true,
    },
    {
        name: 'position-backend',
        path: '/positions/:position',
        component: Recruitment,
        props: true,
    },
    {
        name: 'apply',
        path: '/apply',
        component: ApplyForm,
        props: route => ({ query: route.query.position }),
    },
    {
        name: 'thanks',
        path: '/thanks',
        component: Thanks,
        props: true,
    },
    {
        name: '404',
        path: '/notFound',
        component: NotFound,
        props: true,
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
        next('/notFound')
    } else {
        next()
    }
})

export default router
