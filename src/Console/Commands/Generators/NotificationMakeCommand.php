<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;

class NotificationMakeCommand extends \Illuminate\Foundation\Console\NotificationMakeCommand
{

    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:notification';
}
