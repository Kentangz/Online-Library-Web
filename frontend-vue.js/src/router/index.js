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
    component: () => import('../views/SignIn.vue'),
  },
  {
    path: '/sign-up',
    name: 'SignUp',
    component: () => import('../views/SignUp.vue'),
  },
  {
    path: '/book-list',
    name: 'BookList',
    component: () => import('../views/Book_List/BookList.vue'),
  },

  {
    path: '/book-list/detail-book/:id',  // Menambahkan parameter :id
    name: 'DetailBook',
    component: () => import('../views/Book_List/Detail_Book.vue'),
  },
  

  {
    path: '/dashboard-admin',
    name: 'DashboardAdmin',
    component: () => import('../views/Dashboard_Admin/Dashboard.vue'),
  },

  {
    path: '/dashboard-admin/book-list',
    name: 'BookListAdmin',
    component: () => import('../views/Dashboard_Admin/Manage_Book/Book.vue'),
  },

  {
    path: '/dashboard-admin/book-list/add-book',
    name: 'AddBookAdmin',
    component: () => import('../views/Dashboard_Admin/Manage_Book/AddBook.vue'),
  },

  {
    path: '/dashboard-admin/book-list/edit-book/:id',
    name: 'EditBookAdmin',
    component: () => import('../views/Dashboard_Admin/Manage_Book/EditBook.vue'),
  },
  

  {
    path: '/dashboard-admin/category-list',
    name: 'CategoryListAdmin',
    component: () => import('../views/Dashboard_Admin/Manage_Category/BookCategory.vue'),
  },
  {
    path: '/dashboard-admin/transaction',
    name: 'TransactionAdmin',
    component: () => import('../views/Dashboard_Admin/Transaction.vue'),
  },

  {
    path: '/dashboard-admin/fine',
    name: 'FineAdmin',
    component: () => import('../views/Dashboard_Admin/fine.vue'),
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
