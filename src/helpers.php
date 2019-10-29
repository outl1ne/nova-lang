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
