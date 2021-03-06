# Nova Icon Select

This is a laravel nova field to select an icon from an icon set. The icon sets are defined by an `IconProvider`, so you can define your own set. The package has a predefined `IconProvider` for `FontAwesome 5 Free`.

### Screenshots

### Edit
![Edit](https://raw.githubusercontent.com/bernhardh/nova-icon-select/master/docs/edit.gif)

### Index

![Index](https://raw.githubusercontent.com/bernhardh/nova-icon-select/master/docs/index.png)

### Details

![Detail](https://raw.githubusercontent.com/bernhardh/nova-icon-select/master/docs/detail.png)

## Installation

Install this package with composer

```
composer require bernhardh/nova-icon-select
```

You need to include the styles of the icon set to nova by your own. A common way to do this is to add it to your `resources/views/vendor/nova/partials/meta.blade.php`. 

For `FontAwesome` you can do this like this:

```html
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
```

Of course, you can also host the icon-set on your server or even use completly different icons.

## Usage

Like every other field, you can use the field inside your Nova Resource. You will need to provide an `IconProvider`. Either use the build in `FontAwesomeIconProvider` or use an instance of `IconProvider` or create your own.

```php
use Bernhardh\NovaIconSelect\NovaIconSelect;

NovaIconSelect::make("Icon", "icon")
    ->setIconProvider(/* Instance or classname of an IconProvider */);
```

## Using with FontAwesome 5 Free

For `FontAwesome 5 Free`, there is already a build in Provider. Use it like this:

```php
use Bernhardh\NovaIconSelect\NovaIconSelect;
use Bernhardh\NovaIconSelect\IconProviders\FontAwesomeIconProvider;

NovaIconSelect::make("Icon")
    ->setIconProvider(FontAwesomeIconProvider::class);
```

If you want to change the labels, remove icons or add search tags, you can publish the config:

```
php artisan vendor:publish --provider="Bernhardh\NovaIconSelect\FieldServiceProvider"
```

and now you can modify the `config/nova-icon-select/fontawesome.php` file as you like.

## Using with your own icon sets

To use your own icon set, you can either create your own `IconProvider` class and extend it from `Bernhardh\NovaIconSelect\IconProvider` or you can use `Bernhardh\NovaIconSelect\IconProvider` as an instance and add your options directly.

### Use instance and setOptions

```php
use Bernhardh\NovaIconSelect\NovaIconSelect;
use Bernhardh\NovaIconSelect\IconProvider;

NovaIconSelect::make("Icon")
    ->setIconProvider(IconProvider::make()->setOptions([
        [
            'label' => 'Custom icon 1',
            'value' => 'my-icons-1',
            'search' => ['foo']
        ],
        [
            'label' => 'Custom icon 2',
            'value' => 'my-icons-2',
        ],
        [
            'label' => 'Custom icon 2',
            'value' => 'my-icons-3',
            'search' => ['foo', 'bar']
        ],
    ]));
```

Or you can of course also move the options to a config file and get it with `config()`

```php
use Bernhardh\NovaIconSelect\NovaIconSelect;
use Bernhardh\NovaIconSelect\IconProvider;

NovaIconSelect::make("Icon", "icon")
    ->setIconProvider(
        IconProvider::make()->setOptions(config("iconset"))
    );
```


### Use your own class

```php
use Bernhardh\NovaIconSelect\IconProvider;

class MyCustomIconProvider extends IconProvider {
    
    public function __construct() {
        $this->setOptions([
            [
                'label' => 'Custom icon 1',
                'value' => 'my-icons-1',
                'search' => ['foo']
            ],
            [
                'label' => 'Custom icon 2',
                'value' => 'my-icons-2',
            ],
            [
                'label' => 'Custom icon 2',
                'value' => 'my-icons-3',
                'search' => ['foo', 'bar']
            ],
        ]);
    }
}
```

Now you can use it

```php
use Bernhardh\NovaIconSelect\NovaIconSelect;

NovaIconSelect::make("Icon")
    ->setIconProvider(MyCustomIconProvider::class);
```

## Options

Example:

```php
[
    'label' => 'Custom icon 1',
    'value' => 'my-icons-1',
    'search' => ['foo', 'bar']
]
```

Each option consist of these fields:

- `label`: Required string. This is the value which will be shown in nova and this value is used in the search (checks if label *contains* search string)
- `value`: Required string. This is the actual icon class or identifier which will be stored to the database. In case of `FontAwesome`, this would be something like `fas fa-edit`
- `search:`: Optional string array. This array is used in the search (checks if one of the strings *start with* the search string)
- `unicode`: Optional string. Currently not used

Of course you can move the options to a config file as I did with the `FontAwesomeIconProvider`

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.
