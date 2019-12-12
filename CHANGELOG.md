# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.2.0] - 2019-12-12

### Changed

- changed logic that decides whether to show locales or not.

### Fixed

- Now when user is editing a resource that has a locale that is not defined
in the config file, it will show a dropdown menu. Previously the navigation locale was not shown

## [1.1.0] - 2019-11-11

### Added

 - Added new error toast when user wants to change previously set valid locale
 - When locale assigned to a item is not defined in config file, allows the user to change the locale

### Fixed

 - Fixed when vuex store commit is called from another vue component, now no longer goes into an infinite loop

## [1.0.0] - 2019-11-08

### Added

- Added new field NovaLangField
- new Helpers:

  1. nova_lang_get_all_locales
  2. nova_lang_get_active_locale
  3. nova_lang_set_active_locale helpers

- READ.me and CHANGELOG.md files
- Added watch method to Navigation.vue to read locale parameter in query
- New Nova.Store module

### Changed

- No longer reloads the page when assigning new locale

### Fixed

- Now uses vuex storage to keep and update active locale in vue components.

[1.0.0]: https://github.com/optimistdigital/nova-lang/releases/tag/1.0
[1.1.0]: https://github.com/optimistdigital/nova-lang/compare/1.0.0...1.1.0
[1.2.0]: https://github.com/optimistdigital/nova-lang/compare/1.1.0...1.2.0
