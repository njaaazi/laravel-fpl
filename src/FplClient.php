<?php

declare(strict_types=1);

namespace Njaaazi\Fpl;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class FplClient
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl =  config("fpl.base-url");
    }

    /**
     * @return Collection
     *
     * Returns all general information in one place, for events, game_settings,
     * phases, teams, total_players, elements and elements_type
     */
    public function generalInfo(): Collection
    {
        return Http::get($this->baseUrl . "/bootstrap-static/")->collect();
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
        return Http::get($this->baseUrl . "/fixtures/", [
            "future" => $upcomingFixturesOnly,
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
        return Http::get($this->baseUrl . "/fixtures/", [
            "event" => $gameweek,
        ])->collect();
    }
}
