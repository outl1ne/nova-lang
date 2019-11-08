<?php


// ------------------------------
// nova_lang_get_active_locale
// ------------------------------

if (!function_exists('nova_lang_get_active_locale')) {
    function nova_lang_get_active_locale()
    {
        return request()->session()->get('nova_lang_active_locale', key(config('nova-lang.locales')));
    }
}


// ------------------------------
// nova_lang_get_all_locales
// ------------------------------

if (!function_exists('nova_lang_get_all_locales')) {
    function nova_lang_get_all_locales()
    {
        return config('nova-lang.locales');
    }
}

// ------------------------------
// nova_lang_set_active_locale
// ------------------------------

if (!function_exists('nova_lang_set_active_locale')) {
    function nova_lang_set_active_locale($activeLocale)
    {
        request()->session()->put('nova_lang_active_locale', $activeLocale);
    }
}
