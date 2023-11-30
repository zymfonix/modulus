<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;

class ListenerMakeCommand extends \Illuminate\Foundation\Console\ListenerMakeCommand
{
    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:listener';
}
