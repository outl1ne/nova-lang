<?php

namespace OptimistDigital\NovaLang\LocaleFieldForm;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Nova;

class LocaleFieldForm extends Field
{
    public $component = 'locale-field';
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
