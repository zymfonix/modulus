<?php

// config for Zymfonix/Modulus
use Illuminate\Support\Facades\App;

return [

    /**
     * When set to `true` it will prefix the route path for each module with the module name.
     */
    'prefix_routes' => false,

    /**
     * When set to true will include asset handling
     */
    'provide_assets' => env('MODULUS_PROVIDE_ASSETS', true),

    /**
     * When set to true will include generator commands
     */
    'provide_generators' => env('MODULUS_PROVIDE_GENERATORS', App::isProduction() ? false : true),

];
