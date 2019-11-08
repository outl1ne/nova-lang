import NovaLangStore from '../store/index';
Nova.booting((Vue, router, store) => {
  Vue.component('form-nova-lang-field', require('./components/FormField'));
  Vue.component('index-nova-lang-field', require('./components/IndexField'));
  Vue.component('detail-nova-lang-field', require('./components/DetailField'));
  store.registerModule('nova-lang/nova-lang-storage', NovaLangStore);
});
