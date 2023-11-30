<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Illuminate\Support\Str;
use Zymfonix\Modulus\Concerns\ModuleCommand;

class ModelMakeCommand extends \Illuminate\Foundation\Console\ModelMakeCommand
{
    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:model';

    /**
     * Create a controller for the model.
     *
     * @return void
     */
    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));

        $modelName = $this->qualifyClass('Models\\'.$this->getNameInput());

        $this->call('module:make:controller', [
            'name' => "{$controller}Controller",
            'module' => $this->argument('module'),
            '--model' => $this->option('resource') ? $modelName : null,
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::plural(Str::snake(class_basename($this->argument('name'))));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('module:make:migration', [
            'name' => "create_{$table}_table",
            'module' => $this->argument('module'),
            '--create' => $table,
        ]);
    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));

        $this->call('module:make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->qualifyClass('Models\\'.$this->getNameInput()),
        ]);
    }
}
