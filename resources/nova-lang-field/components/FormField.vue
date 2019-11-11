<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import { getParameterByName } from '../../../../nova-page-manager/resources/js/util';
import { mapGetters } from 'vuex';

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: ['field'],

  data: {
    localeParentId: void 0,
    previouslySetLocale: void 0,
    locale: void 0,
    allowLocaleChange: void 0,
  },
  methods: {
    setInitialValue() {
      this.localeParentId = getParameterByName('localeParentId');
      this.previouslySetLocale = this.field.previouslySetLocale;
      if (this.previouslySetLocale) {
        if (this.field.allLocales.includes(this.previouslySetLocale)) {
          this.locale = this.previouslySetLocale;
          this.allowLocaleChange = false;
        } else {
          this.locale = 'undefined';
          this.allowLocaleChange = true;
        }
      } else {
        this.allowLocaleChange = true;
        this.locale = this.field.locale;
      }
      this.$store.commit('setLocale', this.locale);
    },

    fill(formData) {
      if (this.localeParentId) formData.append(this.field.localeParentIdAttribute, this.localeParentId);
      if (this.allowLocaleChange) {
        if (this.locale) formData.append(this.field.localeAttribute, this.locale);
      }
    },
  },
  watch: {
    async getLocale(newLocale) {
      if (this.allowLocaleChange || newLocale === this.locale) {
        this.locale = newLocale;
      } else {
        this.$store.commit('setLocale', this.locale);
        this.$toasted.show("Can't change locale of an item that already has a valid locale.", { type: 'error' });
      }
    },
  },
  computed: {
    ...mapGetters({ getLocale: 'nova-lang/nova-lang-storage/getLocale' }),
  },
};
</script>
