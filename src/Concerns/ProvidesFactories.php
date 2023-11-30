<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Database\Eloquent\Factory as EloquentFactory;

trait ProvidesFactories
{
    /**
     * Loads the factories.
     */
    protected function bootProvidesFactories()
    {
        $this->app->make(EloquentFactory::class)->load($this->dir.'/database/factories');
    }
}
