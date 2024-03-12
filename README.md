# Laravel Key Migration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/teqnifii/laravel-key-migration.svg?style=flat-square)](https://packagist.org/packages/teqnifii/laravel-key-migration)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/teqnifii/laravel-key-migration/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/teqnifii/laravel-key-migration/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/teqnifii/laravel-key-migration/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/teqnifii/laravel-key-migration/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/teqnifii/laravel-key-migration.svg?style=flat-square)](https://packagist.org/packages/teqnifii/laravel-key-migration)

App Key rotation and migrating records in the DB without the hassles of waiting for everything to update.

## Installation

You can install the package via composer:

```bash
composer require teqnifii/laravel-key-migration
```

### *IMPORTANT NOTE*
> Make sure your models are using the cast type `encrypted` for the fields you want to encrypt:

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YourClass extends Model
{
    protected $casts = [
        'your_column' => 'encrypted',
    ];
}
```

For more information on the `encrypted` cast, see the [Laravel documentation](https://laravel.com/docs/11.x/eloquent-mutators#encrypted-casting).


## Usage

This package contains two commands, `key:rotate` and `key:migrate`.

### `key:rotate`

This command will rotate the application key, and update the `APP_KEY` in the `.env` file, while putting the old key in the `APP_PREVIOUS_KEYS` variable.

> #### The `.env` file must be writable, and does NOT clear any config caching. 
> You will have to still run `config:clear` after to clear any cached configurations.

### `key:migrate`

This command will migrate the records in the database from the old key to the new key. It will look for the `APP_PREVIOUS_KEYS` variable in the `.env` file, and use the old keys to migrate the records.


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Brian Logan](https://github.com/brianclogan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
