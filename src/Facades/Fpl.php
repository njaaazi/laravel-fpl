<?php

namespace Njaaazi\Fpl\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Njaaazi\Fpl\Fpl
 */
class Fpl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-fpl';
    }
}
