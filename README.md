# Nova Lang

This [Laravel Nova](https://nova.laravel.com) package allows you to get and set localization of content.

## Installation

Install the package in a Laravel Nova project via Composer:

```json
 "repositories": [
    {
      "type": "path",
      "url": "./nova-components/nova-lang"
    }
  ],
```
```json
  "require": {
    "optimistdigital/nova-lang": "*"
  },
```
```
#Update/Install composer
composer install
```

Publish the `nova-lang` configuration file and edit it to your preference:

```bash
php artisan vendor:publish --provider="OptimistDigital\NovaLang\ToolServiceProvider" --tag="config"
```

Register the tool with Nova in the `tools()` method of the `NovaServiceProvider`:

```php
// in app/Providers/NovaServiceProvider.php

public function tools()
{
    return [
        // ...
        new \OptimistDigital\NovaLang\NovaLang
    ];
}
```


## Usage 

Call out helper function, where you wish to get active locale
```php
 $activeLocale = nova_lang_get_active_locale()

 //returns active locale key 
```

### Defining locales


```php
// in /config/nova-lang.php

// ...
'locales' => [
  'en' => 'English',
  'et' => 'Estonian',
],
```

## Credits

- [Kaspar Rosin](https://github.com/KasparRosin)

## License

Nova page manager is open-sourced software licensed under the [MIT license](LICENSE.md).
