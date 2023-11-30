<?php

use Zymfonix\Modulus\Facades\Modulus;

if (! function_exists('modulus')) {
    function modulus($module = null)
    {
        if (!$module) {
            return Modulus::instance();
        }

        return Modulus::get($module);
    }
}
