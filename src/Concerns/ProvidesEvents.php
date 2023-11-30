<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Support\Facades\Event;

trait ProvidesEvents
{
    /**
     * Listeners to register.
     *
     * @var array
     */
    protected $listeners = [];

    /**
     * Subscribes to register.
     *
     * @var array
     */
    protected $subscribe = [];

    /**
     * Listen for events.
     */
    protected function loadEvents()
    {
        foreach ($this->listeners as $event => $listeners) {
            foreach ($listeners as $listener) {
                Event::listen($event, $listener);
            }
        }

        foreach ($this->subscribe as $subscriber) {
            Event::subscribe($subscriber);
        }
    }
}
