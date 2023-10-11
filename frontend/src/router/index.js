import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import { useAuthStore } from '@/stores/auth.js';

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/flights/:departure/:destination',
      name: 'flights',
      component: () => import('../views/FlightsView.vue'),
    },
    {
      path: '/register',
      name: 'register',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/RegisterView.vue'),
      meta: {
        unauthenticated: true
      }
    },
    {
      path: '/login',
      name: 'login',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/LoginView.vue'),
      meta: {
        unauthenticated: true
      }
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/DashboardView.vue'),
      meta: {
        auth: true
      }
    },
    {
      path: '/flight/details/:id',
      name: 'flight-details',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/FlightDetailsView.vue'),
      meta: {
        auth: true
      }
    }
  ]
})

router.beforeEach(async (to, from, next) => {
  if (to.meta?.auth) {
    const auth = useAuthStore()
    if (auth.token && auth.user) {
      const isAuthenticated = await auth.checkToken();
      //console.log(isAuthenticated);
      if (isAuthenticated == 'Valid Token') {
        next();
      } else {
        next({ name: 'login' });
      }
    } else {
      next({ name: 'login' })
    }
    //console.log(to.name)
  }

  else if (to.meta?.unauthenticated) {
    const auth = useAuthStore()
    if (auth.token && auth.user) {
      next({ name: 'dashboard' })
    } else {
      next()
    }
  }

  else {
    next()
  }
})

export default router
