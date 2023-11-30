<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Zymfonix\Modulus\Manager;

trait ModuleCommand
{
    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $module = resolve(Manager::class)->get($this->argument('module'));

        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $basePath = base_path('vendor').'/osmaviation/'.$module->getId();

        if (! is_dir($basePath)) {
            $basePath = base_path('vendor').'/zymfonix/'.$module->getId();
        }

        $path = $basePath.'/src'.str_replace('\\', '/', $name).'.php';

        return $path;
    }

    /**
     * Get the root namespace for the class.
     *
     * @return string
     */
    protected function rootNamespace()
    {
        if ($module = resolve(Manager::class)->get($this->argument('module'))) {
            return $module->getNamespace();
        }

        return $this->laravel->getNamespace();
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/');

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->qualifyClass(
            $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name
        );
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class.'],
            ['module', InputArgument::REQUIRED, 'The name of the module.'],
        ];
    }
}
