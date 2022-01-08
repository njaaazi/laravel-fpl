<?php

namespace Njaaazi\Fpl;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Njaaazi\Fpl\Commands\FplCommand;

class FplServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-fpl')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-fpl_table')
            ->hasCommand(FplCommand::class);
    }
}
