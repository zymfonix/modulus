<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;

class JobMakeCommand extends \Illuminate\Foundation\Console\JobMakeCommand
{
    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:job';
}
