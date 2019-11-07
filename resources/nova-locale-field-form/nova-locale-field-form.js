import NovaLangStore from '../store/index';
Nova.booting((Vue, router, store) => {
  Vue.component('form-locale-field', require('./components/FormField'));
  store.registerModule('nova-lang/nova-lang-storage', NovaLangStore);
});
