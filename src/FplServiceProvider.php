<?php

declare(strict_types=1);

namespace Njaaazi\Fpl;

use Njaaazi\Fpl\Commands\FplCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FplServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-fpl')
            ->hasConfigFile();
    }
}
