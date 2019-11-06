let mix = require('laravel-mix');

mix.setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .js('resources/nova-locale-field-form/nova-locale-field-form.js', 'js');

