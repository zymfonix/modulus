<?php

// config for Zymfonix/Modulus
return [

    /**
     * When set to `true` it will prefix the route path for each module with the module name.
     */
    'prefix_routes' => false,

    /**
     * When set to true will include asset handling
     */
    'provide_assets' => env('MODULUS_PROVIDE_ASSETS', true),

];
