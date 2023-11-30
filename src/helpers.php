<?php

use Zymfonix\Modulus\Modulus;

if (! function_exists('modulus')) {
    function modulus($module = null)
    {
        $modulus = resolve(Modulus::class);

        if (! $module) {
            return $modulus->current();
        }

        return $modulus->get($module);
    }
}
