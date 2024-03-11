<?php

namespace Teqnifii\LaravelKeyMigration;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Teqnifii\LaravelKeyMigration\Commands\KeyMigrate;
use Teqnifii\LaravelKeyMigration\Commands\KeyRotate;

class LaravelKeyMigrationServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-key-migration')
//            ->hasConfigFile()
//            ->hasViews()
//            ->hasMigration('create_laravel-key-migration_table')
            ->hasCommand(KeyMigrate::class)
            ->hasCommand(KeyRotate::class);
    }
}
