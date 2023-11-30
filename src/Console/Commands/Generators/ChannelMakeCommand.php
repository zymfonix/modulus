<?php

namespace Zymfonix\Modulus\Console\Commands\Generators;

use Zymfonix\Modulus\Concerns\ModuleCommand;

class ChannelMakeCommand extends \Illuminate\Foundation\Console\ChannelMakeCommand
{
    use ModuleCommand;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'module:make:channel';
}
