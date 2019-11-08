# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

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
