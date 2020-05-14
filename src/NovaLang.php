<?php

namespace OptimistDigital\NovaLang;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaLang extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-lang', __DIR__ . '/../dist/js/tool.js');
        Nova::script('nova-lang-field', __DIR__ . '/../dist/js/nova-lang-field.js');
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-lang::navigation', [
            'locales' => nova_lang_get_all_locales(),
        ]);
    }
}
