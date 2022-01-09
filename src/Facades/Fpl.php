<?php

namespace Njaaazi\Fpl\Facades;

use Illuminate\Support\Facades\Facade;
use Njaaazi\Fpl\FplClient;

/**
 * @see \Njaaazi\Fpl\FplClient
 */
class Fpl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FplClient::class;
    }
}
