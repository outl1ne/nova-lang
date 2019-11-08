<template>
  <div
    class="cursor-pointer items-center font-normal text-white mb-6 text-base no-underline navigation-dropdown-nova-lang"
    v-bind:class="{ active: isActive }"
  >
    <h3 class="flex items-center font-normal text-white mb-6 text-base no-underline" v-on:click="toggleClass()">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        width="22"
        height="22"
        viewBox="0 0 24 24"
        fill="#b3c1d1"
        class="sidebar-icon"
      >
        <path d="M0 0h24v24H0z" fill="none" />
        <path
          d="M11.99 2C6.47 2 2 6.48 2 12s4.47 10 9.99 10C17.52 22 22 17.52 22 12S17.52 2 11.99 2zm6.93 6h-2.95c-.32-1.25-.78-2.45-1.38-3.56 1.84.63 3.37 1.91 4.33 3.56zM12 4.04c.83 1.2 1.48 2.53 1.91 3.96h-3.82c.43-1.43 1.08-2.76 1.91-3.96zM4.26 14C4.1 13.36 4 12.69 4 12s.1-1.36.26-2h3.38c-.08.66-.14 1.32-.14 2 0 .68.06 1.34.14 2H4.26zm.82 2h2.95c.32 1.25.78 2.45 1.38 3.56-1.84-.63-3.37-1.9-4.33-3.56zm2.95-8H5.08c.96-1.66 2.49-2.93 4.33-3.56C8.81 5.55 8.35 6.75 8.03 8zM12 19.96c-.83-1.2-1.48-2.53-1.91-3.96h3.82c-.43 1.43-1.08 2.76-1.91 3.96zM14.34 14H9.66c-.09-.66-.16-1.32-.16-2 0-.68.07-1.35.16-2h4.68c.09.65.16 1.32.16 2 0 .68-.07 1.34-.16 2zm.25 5.56c.6-1.11 1.06-2.31 1.38-3.56h2.95c-.96 1.65-2.49 2.93-4.33 3.56zM16.36 14c.08-.66.14-1.32.14-2 0-.68-.06-1.34-.14-2h3.38c.16.64.26 1.31.26 2s-.1 1.36-.26 2h-3.38z"
        />
      </svg>
      <span class="sidebar-label dim items-center"> {{ locales[activeLocale] }} </span>
    </h3>
    <div>
      <ul class="list-reset mb-8">
        <li
          class="leading-wide mb-4 text-sm ml-8 no-underline dim"
          v-for="(value, key) in locales"
          v-bind:class="{ 'router-link-exact-active router-link-active': locales[activeLocale] === value }"
          v-on:click="setActiveLocale(key)"
        >
          {{ value }}
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  props: ['locales'],
  name: 'Navigation',
  data: function() {
    return {
      activeLocale: void 0,
      localeParent: void 0,
      isActive: false,
      resourceName: null,
    };
  },
  methods: {
    toggleClass() {
      this.isActive = !this.isActive;
    },
    setActiveLocale(selectedLocale) {
      Nova.request()
        .post(`/nova-vendor/nova-lang/novaLangUpdateActiveLocale/${selectedLocale}`)
        .then(
          () => {
            this.$store.commit('setLocale', selectedLocale);
            this.isActive = false;
          },
          () => {
            this.$toasted.show('Failed to update selected locale!', { type: 'error' });
          }
        );
    },
    async getActiveLocale() {
      try {
        return Nova.request().get(`/nova-vendor/nova-lang/novaLangGetActiveLocale`);
      } catch (error) {
        this.$toasted.show('Failed to get locale!', { type: 'error' });
      }
    },
    async getAllLocales() {
      try {
        return Nova.request().get('/nova-vendor/nova-lang/novaLangGetAllLocales');
      } catch (error) {
        this.$toasted.show(error, { type: 'error' });
      }
    },
    async reloadResources() {
      this.resourceName = this.$router.currentRoute.params.resourceName || this.$router.currentRoute.name;
      if (this.resourceName) {
        let filters_backup = _.cloneDeep(this.$store.getters[`${this.resourceName}/filters`]);
        let filters_to_change = _.cloneDeep(filters_backup);
        filters_to_change.push({});
        await this.$store.commit(`${this.resourceName}/storeFilters`, filters_to_change);
        await this.$store.commit(`${this.resourceName}/storeFilters`, filters_backup);
      }
    },
  },
  watch: {
    getLocale(newLocale) {
      this.activeLocale = newLocale;
      this.setActiveLocale(newLocale);
      this.reloadResources();
    },
    $route: async function($route) {
      if (this.activeLocale === void 0) {
        this.activeLocale = (await this.getActiveLocale()).data;
      }
      if ($route.query.locale !== void 0 && this.activeLocale !== $route.query.locale) {
        const getAllLocales = (await this.getAllLocales()).data;
        const localeKeys = Object.keys(getAllLocales);
        if (localeKeys.includes($route.query.locale)) this.setActiveLocale($route.query.locale);
        else {
          this.$toasted.show('Locale is not defined in config file', { type: 'error' });
        }
      }
    },
  },
  computed: {
    ...mapGetters({ getLocale: 'nova-lang/nova-lang-storage/getLocale' }),
  },
};
</script>

<style lang="scss" scoped>
.navigation-dropdown-nova-lang {
  height: 25px;
  overflow: hidden;
  user-select: none;
}

.active {
  height: unset;
  overflow: unset;
}
</style>
