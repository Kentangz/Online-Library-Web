import { createRouter, createWebHistory } from 'vue-router';

const routes = [
  { 
    path: '/',
    name: 'Home',
    component: () => import('../views/Home.vue'),

},
  { 
    path: '/login',
    name: 'Login',
    component: () => import('../views/Login.vue'),},

{
    path: '/about-us',
    name: 'AboutUs',
    component: () => import('../views/UsefulLinks/AboutUs.vue'),
},
{
    path: '/privacy-policy',
    name: 'PrivacyPolicy',
    component: () => import('../views/UsefulLinks/PrivacyPolicy.vue'),
},
{
  path: '/terms-of-service',
  name: 'TermsOfService',
  component: () => import('../views/UsefulLinks/TermsOfService.vue'),
}
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
