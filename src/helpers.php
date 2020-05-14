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
        $locales = config('nova-lang.locales', ['en' => 'English']);
        if (is_callable($locales)) return call_user_func($locales);
        if (is_array($locales)) return $locales;
        return ['en' => 'English'];
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
