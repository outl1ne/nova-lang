<?php

namespace OptimistDigital\NovaLang\LocaleFieldForm;

use Laravel\Nova\Fields\Field;
use Laravel\Nova\Http\Requests\NovaRequest;

class LocaleFieldForm extends Field
{
    public $component = 'locale-field';
    protected $localeParentIdAttribute;

    public function __construct($name, $localeAttribute, $localeParentIdAttribute = '', $resolveCallback = null)
    {
        parent::__construct($name, $localeAttribute, $resolveCallback);
        $this->localeParentIdAttribute = $localeParentIdAttribute;
        $this->withMeta([
            'locale' => nova_lang_get_active_locale(),
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
