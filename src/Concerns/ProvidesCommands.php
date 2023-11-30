<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Console\Scheduling\Schedule;

trait ProvidesCommands
{
    /**
     * Commands to register.
     *
     * @var array
     */
    protected $commands = [];

    /**
     * Loads the commands if the application is running in the console.
     */
    protected function bootProvidesCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands($this->commands);
        }

        if (method_exists($this, 'schedule')) {
            $this->app->booted(function () {
                $schedule = $this->app->make(Schedule::class);
                $this->schedule($schedule);
            });
        }
    }
}
