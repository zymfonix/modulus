<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Illuminate\Support\Str;
use Zymfonix\Modulus\Concerns\ModuleCommand;
use Zymfonix\Modulus\Manager;

class ControllerMakeCommand extends \Illuminate\Routing\Console\ControllerMakeCommand
{
    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:controller';

    /**
     * Get the fully-qualified model class name.
     *
     * @param  string  $model
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    protected function parseModel($model)
    {
        if (preg_match('([^A-Za-z0-9_/\\\\])', $model)) {
            throw new InvalidArgumentException('Model name contains invalid characters.');
        }

        $model = trim(str_replace('/', '\\', $model), '\\');

        $rootNamespace = $this->laravel->getNamespace();
        if ($module = resolve(Manager::class)->get($this->argument('module'))) {
            $rootNamespace = $module->getNamespace().'\\Models';
        }

        if (! Str::startsWith($model, $rootNamespace)) {
            $model = $rootNamespace.$model;
        }

        return $model;
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'NamespacedDummyUserModel'],
            [$this->getNamespace($name), 'App\\', $this->userProviderModel()],
            $stub
        );

        return $this;
    }
}
