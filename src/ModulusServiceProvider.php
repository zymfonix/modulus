<?php

namespace Zymfonix\Modulus;

use Illuminate\Support\Facades\Config;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TorMorten\Mix\MixServiceProvider;

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

        if (Config::get('modulus.provide_assets', true)) {
            $this->app->register(MixServiceProvider::class);

            config([
                'mix.driver.cdn' => [
                    'include_vendor' => env('MIX_CDN_INCLUDE_VENDOR', false),
                    'url' => env('MIX_CDN_URL', 'https://cdn.osmaviation.io'),
                    'format' => env('MIX_CDN_FORMAT', '{url}/{package}/{version}/{path}'),
                ],
                'route.enabled' => $this->app->environment('local'),
            ]);
        }
    }
}
