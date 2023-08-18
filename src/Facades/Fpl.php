<?php

declare(strict_types=1);

namespace Njaaazi\Fpl\Facades;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Facade;
use Njaaazi\Fpl\FplClient;

/**
 * @see \Njaaazi\Fpl\FplClient
 * @method static Collection generalInfo()
 * @method static Collection allFixtures(bool $upcomingFixturesOnly = false)
 * @method static Collection gameweekFixtures(int $gameweek = 1)
 */
class Fpl extends Facade
{
    protected static function getFacadeAccessor()
    {
        return FplClient::class;
    }
}
