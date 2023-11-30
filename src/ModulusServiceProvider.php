<?php

namespace Zymfonix\Modulus;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ModulusServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('modulus')
            ->hasConfigFile();
    }

    public function packageRegistered()
    {
        $this->app->singleton(Modulus::class);
    }
}
