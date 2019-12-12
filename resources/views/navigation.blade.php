@if(count($locales) >= 1 || !$errors)
    <div>
        <locale-dropdown v-bind:locales="{{json_encode($locales)}}"/>
    </div>
@endif
