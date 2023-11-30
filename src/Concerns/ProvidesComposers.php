<?php

namespace Zymfonix\Modulus\Concerns;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\View;

trait ProvidesComposers
{
    /**
     * Composers to register.
     *
     * @var array
     */
    protected $composers = [];

    /**
     * Register composers
     */
    protected function bootProvidesComposers()
    {
        foreach ($this->composers as $view => $composer) {
            $composer = Arr::wrap($composer);
            foreach ($composer as $item) {
                View::composer(
                    $view, $item
                );
            }
        }
    }
}
