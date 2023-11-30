<?php

namespace Zymfonix\Modulus\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Zymfonix\Modulus\Modulus
 */
class Modulus extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Zymfonix\Modulus\Modulus::class;
    }
}
