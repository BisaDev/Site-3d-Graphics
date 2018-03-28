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
        meta: {
      title: 'Maniak 〰 A design and technology studio in Guadalajara, Mexico',
      metaTags: [
        {
          name: 'description',
          content: 'We are Maniak. Think of us as controlled kind of crazy with a deep passion for creative disruption.'
        }
       ],
    },
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
    meta: {
      title: 'Work 〰 Maniak',
      metaTags: [
        {
          name: 'description',
          content: 'Maniak does stuff. Which is good.'
        }
      ],
    },
    props: true,
  },
  {
    name: 'studio',
    path: '/studio',
    component: Studio,
    meta: {
      title: 'Studio 〰 Maniak',
      metaTags: [
        {
          name: 'description',
          content: 'Maniak is a design and technology studio in Guadalajara, Mexico. We build websites, applications and interactive experiences.'
        }
      ],
    },
    props: true,
  },
  {
    name: 'contact',
    path: '/contact',
    component: Contact,
    meta: {
      title: 'Contact 〰 Maniak',
      metaTags: [
        {
          name: 'description',
          content: 'If you’d like to partner on a project or simply chat about what we could do together, just say hello@maniak.co.'
        }
      ],
    },
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
    meta: {
      title: '404 〰 Maniak'
    },
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


// This callback runs before every route change, including on page load.
// Check this link: https://alligator.io/vuejs/vue-router-modify-head/
router.beforeEach((to, from, next) => {
  const nearestWithTitle = to.matched.slice().reverse().find(r => r.meta && r.meta.title);
  const nearestWithMeta = to.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
  const previousNearestWithMeta = from.matched.slice().reverse().find(r => r.meta && r.meta.metaTags);
  if(nearestWithTitle) document.title = nearestWithTitle.meta.title;

  Array.from(document.querySelectorAll('[data-vue-router-controlled]')).map(el => el.parentNode.removeChild(el));

  if(!nearestWithMeta) return next();
  nearestWithMeta.meta.metaTags.map(tagDef => {
    const tag = document.createElement('meta');

    Object.keys(tagDef).forEach(key => {
      tag.setAttribute(key, tagDef[key]);
    });
    tag.setAttribute('data-vue-router-controlled', '');
    return tag;
  })
  .forEach(tag => document.head.appendChild(tag));
  next();
});


router.beforeEach((to, from, next) => {
    if (!to.matched.length) {
        next('/notFound')
    } else {
        next()
    }
})

export default router