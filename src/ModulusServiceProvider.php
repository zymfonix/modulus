<?php

namespace Zymfonix\Modulus;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Zymfonix\Modulus\Commands\ModulusCommand;

class ModulusServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('modulus')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_modulus_table')
            ->hasCommand(ModulusCommand::class);
    }
}
