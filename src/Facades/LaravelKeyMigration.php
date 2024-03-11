<?php

namespace Teqnifii\LaravelKeyMigration\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Teqnifii\LaravelKeyMigration\LaravelKeyMigration
 */
class LaravelKeyMigration extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Teqnifii\LaravelKeyMigration\LaravelKeyMigration::class;
    }
}
