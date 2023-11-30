<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;

class PolicyMakeCommand extends \Illuminate\Foundation\Console\PolicyMakeCommand
{

    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:policy';
}
