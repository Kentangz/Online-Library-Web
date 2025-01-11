import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  { 
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),
},
{
  path: '/sign-in',
  name: 'SignIn',
  component: () => import('../components/SignIn.vue'),
},
{
  path: '/sign-up',
  name: 'SignUp',
  component: () => import('../components/SignUp.vue'),
},
{
  path: '/book-list',
  name: 'BookList',
  component: () => import('../views/BookList.vue'),
},
{
  path: '/profile',
  name: 'Profile',
  component: () => import('../views/Profile.vue'),
},
{
    path: '/about-us',
    name: 'AboutUs',
    component: () => import('../views/UsefulLinks/AboutUs.vue'),
},
{
    path: '/FAQ',
    name: 'FaQ',
    component: () => import('../views/UsefulLinks/FaQ.vue'),
},
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
