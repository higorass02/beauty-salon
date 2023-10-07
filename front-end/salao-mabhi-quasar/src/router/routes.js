const routes = [
  {
    path: '/login',
    component: () => import('layouts/Login/layoutLogin.vue'),
    children: [
      { path: '', name: 'login', component: () => import('src/pages/Login/index.vue') }
    ]
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: '/:catchAll(.*)*',
    component: () => import('pages/ErrorNotFound.vue')
  },
  {
    path: '',
    name: 'home',
    component: () => import('layouts/Home.vue'),
    children: [
      { path: '', name: 'homePage', component: () => import('src/pages/Home/home.vue') }
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
  },
  {
    path: '/service',
    component: () => import('layouts/Home.vue'),
    children: [
      { path: '', name: 'service', component: () => import('src/pages/Services/ListServicePage.vue') },
      { path: 'novo', name: 'createService', component: () => import('src/pages/Services/CreateServicePage.vue') },
      { path: ':id/edit', name: 'editService', component: () => import('src/pages/Services/EditServicePage.vue') }
    ]
  },
  {
    path: '/employee',
    component: () => import('layouts/Home.vue'),
    children: [
      { path: '', name: 'employee', component: () => import('src/pages/Employees/ListEmployeePage.vue') },
      { path: 'novo', name: 'createEmployee', component: () => import('src/pages/Employees/CreateEmployeePage.vue') },
      { path: ':id/edit', name: 'editEmployee', component: () => import('src/pages/Employees/EditEmployeePage.vue') }
    ]
  },
  {
    path: '/appointment',
    component: () => import('layouts/Home.vue'),
    children: [
      { path: '', name: 'appointment', component: () => import('src/pages/appointments/ListAppointmentPage.vue') },
      { path: 'novo', name: 'createAppointment', component: () => import('src/pages/appointments/CreateAppointmentPage.vue') },
      { path: ':id/edit', name: 'editAppointment', component: () => import('src/pages/appointments/EditAppointmentPage.vue') }
    ]
  }
]

export default routes
