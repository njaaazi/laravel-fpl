<?php

namespace Njaaazi\Fpl;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use phpDocumentor\Reflection\Types\Boolean;

class FplClient
{

    const API_URL = 'https://fantasy.premierleague.com/api';

    /**
     * @return Collection
     *
     * Returns all general information in one place, for events, game_settings,
     * phases, teams, total_players, elements and elements_type
     */
    public function generalInfo(): Collection
    {
        return Http::get(self::API_URL.'/bootstrap-static/')->collect();
    }

    /**
     * @param bool $upcomingFixturesOnly
     * @return Collection
     *
     * Returns all fixtures for the season, if set to true it will only
     * return upcomingFixtures
     */
    public function allFixtures(bool $upcomingFixturesOnly = false): Collection
    {
        return Http::get(self::API_URL.'/fixtures/',[
            'future' => $upcomingFixturesOnly,
        ])->collect();
    }

    /**
     * @param int $gameweek
     * @return Collection
     *
     * Returns all fixtures for specific gameweek, defaults to first gameweek.
     */
    public function gameweekFixtures(int $gameweek = 1): Collection
    {
        return Http::get(self::API_URL.'/fixtures/', [
            'event' => $gameweek,
        ])->collect();
    }

}
