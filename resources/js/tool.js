Nova.booting((Vue, router, store) => {
  router.addRoutes([
    {
      name: 'nova-lang',
      path: '/nova-lang',
      component: require('./components/Tool'),
    },
  ])
  Vue.component('locale-dropdown', require('./components/Navigation'));
})
