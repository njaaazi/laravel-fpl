# Fantasy Premier League API wrapper for Laravel. (WIP, not ready for production use)

[![Tests](https://github.com/njaaazi/laravel-fpl/actions/workflows/tests.yml/badge.svg)](https://github.com/njaaazi/laravel-fpl/actions/workflows/tests.yml)
[![codecov](https://codecov.io/gh/njaaazi/laravel-fpl/graph/badge.svg?token=F6BDYJJ5E4)](https://codecov.io/gh/njaaazi/laravel-fpl)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/njaaazi/laravel-fpl.svg?style=flat-square)](https://packagist.org/packages/njaaazi/laravel-fpl)
[![Total Downloads](https://img.shields.io/packagist/dt/njaaazi/laravel-fpl.svg?style=flat-square)](https://packagist.org/packages/njaaazi/laravel-fpl)

Fantasy Premier League API wrapper for Laravel.

## Installation

You can install the package via composer:

```bash
composer require njaaazi/laravel-fpl
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-fpl-config"
```

This is the contents of the published config file:

```php
return [
    "base-url" => env(
        "FPL_BASE_URL",
        "https://fantasy.premierleague.com/api",
    ),
];
```

## Usage

```php
use Njaaazi\Fpl\FplClient;

$fpl = new FplClient;

$generalInfo = $fpl->generalInfo();
$allFixtures = $fpl->allFixtures();
```

### Using Facade

```php
use Njaaazi\Fpl\Facades\Fpl;

$generalInfo = Fpl::generalInfo();
$allFixtures = Fpl::allFixtures();
```

## Testing

```bash
vendor/bin/phpunit
```

or

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Njazi Shehu](https://github.com/njaaazi)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
