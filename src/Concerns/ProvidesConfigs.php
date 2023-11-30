<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

trait ProvidesConfigs
{
    /**
     * Register config.
     */
    protected function bootProvidesConfigs()
    {
        collect(File::glob(Str::finish($this->dir, '/').'config/*.php'))->each(function ($configFile) {
            $this->publishes([
                $configFile => config_path(basename($configFile)),
            ], $this->module->getId().'.'.str_replace('.php', '', basename($configFile)));

            $this->mergeConfigFrom(
                $configFile,
                str_replace('.php', '', basename($configFile))
            );
        });
    }
}
