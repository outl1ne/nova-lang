<?php

namespace OptimistDigital\NovaLang\Http\Controllers;

use Illuminate\Routing\Controller;

class LocaleController extends Controller
{

    public function update($activeLocale)
    {
        request()->session()->put('nova_lang_active_locale', $activeLocale);
    }

    public function show()
    {
        return request()->session()->get('nova_lang_active_locale', key(config('nova-lang.locales')));
    }
}
