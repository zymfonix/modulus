<?php

namespace Zymfonix\Modulus\Concerns;

trait ProvidesViews
{
    protected function bootProvidesViews()
    {
        $this->loadViewsFrom($this->dir . '/resources/views', $this->module->getId());
    }
}
