<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Zymfonix\Modulus\Manager;

trait ModuleCommand
{
    protected function getBasePath()
    {
        $module = resolve(Manager::class)->get($this->argument('module'));
        if (!$module) {
            throw new \Exception('No such module "' . $this->argument('module') . '" exists.');
        }
        $package = $module->getPackage();

        return base_path('vendor') . '/' . $package->name;
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);

        $path = $this->getBasePath() . '/src' . str_replace('\\', '/', $name) . '.php';

        return $path;
    }

    /**
     * Returns the description for the command.
     */
    public function getDescription(): string
    {
        return 'Modulus: ' . $this->description;
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
     * @param string $name
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
            $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name
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
