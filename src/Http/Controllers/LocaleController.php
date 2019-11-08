<?php

namespace OptimistDigital\NovaLang\Http\Controllers;

use Illuminate\Routing\Controller;

class LocaleController extends Controller
{

    public function update($activeLocale)
    {
        nova_lang_set_active_locale($activeLocale);
    }

    public function show()
    {
        return nova_lang_get_active_locale();
    }

    public function index()
    {
        return nova_lang_get_all_locales();
    }
}
