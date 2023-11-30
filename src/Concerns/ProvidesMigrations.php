<?php

namespace Zymfonix\Modulus\Concerns;

trait ProvidesMigrations
{
    protected function bootProvidesMigrations()
    {
        $this->loadMigrationsFrom($this->dir.'/database/migrations');
    }
}
