<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;
use Zymfonix\Modulus\Manager;

class FactoryMakeCommand extends \Illuminate\Database\Console\Factories\FactoryMakeCommand
{

    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:factory';


    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $model = $this->option('model')
            ? $this->qualifyClass('Models\\' . $this->option('model'))
            : 'Model';

        return str_replace(
            'DummyModel', $model, parent::buildClass($name)
        );
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = str_replace(
            ['\\', '/'], '', $this->argument('name')
        );

        $module = resolve(Manager::class)->get($this->argument('module'));

        return base_path('vendor') . '/osmaviation/' . $module->getId() . "/database/factories/{$name}.php";
    }
}
