<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;

class ProviderMakeCommand extends \Illuminate\Foundation\Console\ProviderMakeCommand
{
    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:provider';
}
