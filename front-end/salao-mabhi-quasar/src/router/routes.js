const routes = [
  {
    path: '/login',
    component: () => import('layouts/Login/layoutLogin.vue'),
    children: [
      { path: '', name: 'home', component: () => import('src/pages/Login/index.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  },
  {
    path: '/',
    name: 'home',
    component: () => import('layouts/Home.vue'),
    children: [
      { path: '', name: 'home', component: () => import('src/pages/Home/home.vue') }
    ]
  },
  {
    path: '/customer',
    component: () => import('layouts/Home.vue'),
    children: [
      { path: '', name: 'customer', component: () => import('src/pages/Customer/ListCustomerPage.vue') },
      { path: 'novo', name: 'formCustomer', component: () => import('src/pages/Customer/FormCustomerPage.vue') },
      { path: ':id/edit', name: 'formEditCustomer', component: () => import('src/pages/Customer/FormEditCustomerPage.vue') }
    ]
  }
]

export default routes
