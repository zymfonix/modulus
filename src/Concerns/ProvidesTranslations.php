<?php

namespace Zymfonix\Modulus\Concerns;

trait ProvidesTranslations
{
    protected function bootProvidesTranslations()
    {
        $this->loadTranslationsFrom($this->dir.'/resources/lang', $this->module->getId());
    }
}
