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
            ->setBasePath(pathinfo((new \ReflectionClass(self::class))->getFileName())['dirname'])
            ->hasConfigFile();
    }

    public function bootingPackage()
    {
        $this->commands(Config::get('modulus.provide_generators', true) && $this->app->runningInConsole() ? [
            Console\Commands\Generators\ChannelMakeCommand::class,
            Console\Commands\Generators\ConsoleMakeCommand::class,
            Console\Commands\Generators\ControllerMakeCommand::class,
            Console\Commands\Generators\EventMakeCommand::class,
            Console\Commands\Generators\ExceptionMakeCommand::class,
            Console\Commands\Generators\JobMakeCommand::class,
            Console\Commands\Generators\ListenerMakeCommand::class,
            Console\Commands\Generators\MailMakeCommand::class,
            Console\Commands\Generators\MiddlewareMakeCommand::class,
            Console\Commands\Generators\MigrateMakeCommand::class,
            Console\Commands\Generators\ModelMakeCommand::class,
            Console\Commands\Generators\NotificationMakeCommand::class,
            Console\Commands\Generators\ObserverMakeCommand::class,
            Console\Commands\Generators\PolicyMakeCommand::class,
            Console\Commands\Generators\ProviderMakeCommand::class,
            Console\Commands\Generators\RequestMakeCommand::class,
            Console\Commands\Generators\ResourceMakeCommand::class,
            Console\Commands\Generators\RuleMakeCommand::class,
        ] : []);
    }

    public function packageRegistered()
    {
        $this->app->singleton(Modulus::class);

        if (Config::get('modulus.provide_assets', true)) {
            $this->app->register(MixServiceProvider::class);

            config([
                'mix.driver.cdn' => [
                    'include_vendor' => env('MIX_CDN_INCLUDE_VENDOR', false),
                    'url' => env('MIX_CDN_URL', 'https://cdn.zymfonixportal.com'),
                    'format' => env('MIX_CDN_FORMAT', '{url}/{package}/{version}/{path}'),
                ],
                'route.enabled' => $this->app->environment('local'),
            ]);
        }
    }
}
