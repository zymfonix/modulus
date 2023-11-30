<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;

class ObserverMakeCommand extends \Illuminate\Foundation\Console\ObserverMakeCommand
{
    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:observer';
}
