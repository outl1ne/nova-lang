export default {
  state: {
    locale: void 0,
  },
  getters: {
    'nova-lang/nova-lang-storage/getLocale': state => {
      return state.locale;
    },
  },
  mutations: {
    setLocale: (state, locale) => (state.locale = locale),
  },
};
