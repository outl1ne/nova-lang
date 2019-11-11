<?php

namespace OptimistDigital\NovaLang\NovaLangField;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class NovaLangField extends Field
{
    public $component = 'nova-lang-field';
    protected $localeParentIdAttribute;
    protected $localeAttribute;

    public function __construct($name, $localeAttribute, $localeParentIdAttribute = '', $resolveCallback = null)
    {
        parent::__construct($name, $localeAttribute, $resolveCallback);
        $this->localeParentIdAttribute = $localeParentIdAttribute;
        $this->localeAttribute = $localeAttribute;

    }


    public function resolve($resource, $attribute = null)
    {
        parent::resolve($resource, $attribute);
        $previouslySetLocale = $resource->{$this->attribute};

        $localeParentIdAttribute = $this->localeParentIdAttribute;
        $localeAttribute = $this->localeAttribute;

        $this->withMeta([
            'allLocales' => array_keys(nova_lang_get_all_locales()),
            'previouslySetLocale' => $previouslySetLocale,
            'locale' =>  nova_lang_get_active_locale(),
            'localeParentIdAttribute' => $localeParentIdAttribute,
            'localeAttribute' => $localeAttribute,
        ]);
    }

    public function fill(NovaRequest $request, $model)
    {
        $this->fillInto($request, $model, $this->localeParentIdAttribute, $this->localeParentIdAttribute);
        return $this->fillInto($request, $model, $this->attribute, $this->attribute);
    }
}
