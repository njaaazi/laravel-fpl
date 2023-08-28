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
        $this->baseUrl = config("fpl.base-url");
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
     * @return Collection
     *
     * Returns all fixtures for the season.
     */
    public function allFixtures(): Collection
    {
        return Http::get($this->baseUrl . "/fixtures/", [
            "future" => false,
        ])->collect();
    }

    /**
     * @return Collection
     *
     * Returns all upcomingFixtures only for the season.
     */
    public function allUpcomingFixtures(): Collection
    {
        return Http::get($this->baseUrl . "/fixtures/", [
            "future" => true,
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

    /**
     * @param int $playerId
     * @return Collection
     *
     * Returns a player’s detailed information.
     */
    public function playersDetailedData(int $playerId): Collection
    {
        return Http::get($this->baseUrl . "/element-summary/{$playerId}")
            ->collect();
    }

    /**
     * @param int $gameweek
     * @return Collection
     *
     * Returns a list of player's information in that specific Gameweek.
     */
    public function gameweekLiveData(int $gameweek): Collection
    {
        return Http::get($this->baseUrl . "/event/{$gameweek}/live/")
            ->collect();
    }

    /**
     * @param int $managerId
     * @return array
     *
     * This endpoint returns managers or FPL users basic information.
     */
    public function managerBasicInformation(int $managerId): array
    {
        return Http::get($this->baseUrl . "/entry/{$managerId}/")
            ->json();
    }

    /**
     * @param int $managerId
     * @return array
     *
     * This endpoint returns a managers data from previous Gameweeks (current),
     * previous seasons (past), and chips that already used during this season.
     */
    public function managerHistory(int $managerId): array
    {
        return Http::get($this->baseUrl . "/entry/{$managerId}/history/")
            ->json();
    }

    /**
     * @param int $leagueId
     * @param int $page
     * @return array
     *
     * This endpoint returns the classic league standings.
     */
    public function classicLeagueStandings(int $leagueId, int $page = 1): array
    {
        return Http::get($this->baseUrl . "/leagues-classic/$leagueId/standings/", [
            "page_standing" => $page,
        ])->json();
    }

    /**
     * @param int $managerId
     * @param int $gameweek
     * @return array
     *
     * This endpoint returns the latest or currently active Gameweek.
     */
    public function managersTeam(int $managerId, int $gameweek): array
    {
        return Http::get($this->baseUrl . "/entry/$managerId/event/$gameweek/picks/")
            ->json();
    }
}
