# Provides a captcha field for the Filament Forms

[![Latest Version on Packagist](https://img.shields.io/packagist/v/yepsua/filament-captcha-field.svg?style=flat-square)](https://packagist.org/packages/yepsua/filament-captcha-field)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/yepsua/filament-captcha-field/run-tests?label=tests)](https://github.com/yepsua/filament-captcha-field/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/yepsua/filament-captcha-field/Check%20&%20fix%20styling?label=code%20style)](https://github.com/yepsua/filament-captcha-field/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/yepsua/filament-captcha-field.svg?style=flat-square)](https://packagist.org/packages/yepsua/filament-captcha-field)

Easy integration with [mewebstudio/captcha](https://github.com/mewebstudio/captcha) for the Filament forms. 

## Requirements:

- PHP extension: ext-gd

## Installation

Install the package via composer:

```bash
composer require yepsua/filament-captcha-field
```

Publish the package mewebstudio/captcha config file:

```bash
php artisan vendor:publish --provider="Mews\Captcha\CaptchaServiceProvider" --tag="config"
```

## Usage

You can include the captcha field like any other filament field.

```php
    use Yepsua\Filament\Forms\Components\Captcha;
    ...
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('username'),
            Forms\Components\TextInput::make('password')->type('password'),
            Captcha::make('captcha')
        ];
    }

```

You can also just display the image and validate the captcha using any other TextInput field:

```php
    use Yepsua\Filament\Forms\Components\CaptchaImage;
    ...
    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('username'),
            Forms\Components\TextInput::make('password')->type('password'),
            Forms\Components\TextInput::make('captcha')->required()->rules('required|captcha'),
            CaptchaImage::make('captchaImg')
        ];
    }

```

The captcha uses by default the `flat` config. You can create/update the captcha configs in the file: `config/captcha.php`.

You can switch to any other available captcha config, like the `math` config:

```php
    use Yepsua\Filament\Forms\Components\Captcha;
    ...
    protected function getFormSchema(): array
    {
        return [
            Captcha::make('captcha')->config('math')
        ];
    }
```

For more info about the captcha configuration, please read the [mewebstudio/captcha](https://github.com/mewebstudio/captcha) documentation.

## Translations

This package and mewebstudio/captcha don't provide any translation for the captcha validation message, but you can translate the message by yourself, just add the item in the file `resources/lang/{lang}/validation.php`

```php
return [
    ...
    'captcha'             => 'Invalid captcha.',
    ...
]
```

## Case of use: Add a captcha in the filament login form:

1. Extend the Login page class to add the new field into the form:

```php

<?php

namespace  App\Filament\Pages\Auth;

use Filament\Http\Livewire\Auth\Login as BaseLoginPage;
use Yepsua\Filament\Forms\Components\Captcha;

class Login extends BaseLoginPage
{

    protected function getFormSchema(): array
    {
        $formSchema = parent::getFormSchema();
        $formSchema[] = Captcha::make('captcha');

        return $formSchema;
    }
}
```

2. Use the new Login page instead the original filament page.

```php 

return [
    ...
    'auth' => [
        'guard' => env('FILAMENT_AUTH_GUARD', 'web'),
        'pages' => [
            // 'login' => \Filament\Http\Livewire\Auth\Login::class, // <- Original form
            'login' => \App\Filament\Pages\Auth\Login::class,        // <- Form with captcha
        ],
    ],
    ...
]
```

3. Done. Finally you can test the captcha in the login form.

<p align="center">
    <img src="https://user-images.githubusercontent.com/1541517/167027574-1bc08a97-a64d-4f25-a532-073d770423c5.png" />
</p>

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/master/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Omar Yepez](https://github.com/oyepez003)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
