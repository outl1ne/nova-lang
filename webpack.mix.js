let mix = require('laravel-mix');

mix
  .setPublicPath('dist')
  .js('resources/js/tool.js', 'js')
  .js('resources/nova-lang-field/nova-lang-field.js', 'js');
