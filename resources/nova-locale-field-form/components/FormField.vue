<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova';
import { getParameterByName } from '../../../../nova-page-manager/resources/js/util';

export default {
  mixins: [FormField, HandlesValidationErrors],
  props: ['field'],

  data: {
    localeParentId: void 0,
    locale: void 0,
  },
  methods: {
    setInitialValue() {
      this.localeParentId = getParameterByName('localeParentId');
      this.locale = this.field.locale;
    },

    fill(formData) {
      if (this.localeParentId) formData.append(this.field.localeParentIdAttribute, this.localeParentId);
      if (this.locale) formData.append(this.field.localeAttribute, this.locale);
    },
  },
};
</script>
