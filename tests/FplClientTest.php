<?php

declare(strict_types=1);

namespace Njaaazi\Fpl\Tests;

use Illuminate\Support\Facades\Http;
use Njaaazi\Fpl\FplClient;

class FplClientTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Http::fake([
            "*/bootstrap-static/" => Http::response(
                $this->loadFixture("bootstrap-static.json"),
                200,
            ),
            "*/fixtures/" => Http::response(
                $this->loadFixture("fixtures.json"),
                200,
            ),
            "*/fixtures/?future=1" => Http::response(
                $this->loadFixture("upcoming-fixtures.json"),
                200,
            ),
            "*/fixtures/?event=1" => Http::response(
                $this->loadFixture("first-gameweek-fixtures.json"),
                200,
            ),
            "*/element-summary/*/" => Http::response(
                $this->loadFixture("element-summary.json"),
                200,
            ),
            "*/event/*/live/" => Http::response(
                $this->loadFixture("event.json"),
                200,
            ),
            "*/entry/*/history/" => Http::response(
                $this->loadFixture("manager-history.json"),
                200,
            ),
            "*/entry/*/event/*/picks/" => Http::response(
                $this->loadFixture("managers-team-per-gameweek.json"),
                200,
            ),
            "*/entry/*/" => Http::response(
                $this->loadFixture("manager-basic-information.json"),
                200,
            ),
            "*/leagues-classic/*/standings/?page_standings=*" => Http::response(
                $this->loadFixture("classic-league-standings.json"),
                200,
            ),
            "*/event-status/" => Http::response(
                $this->loadFixture("event-status.json"),
                200,
            ),
            "*/dream-team/*/" => Http::response(
                $this->loadFixture("dream-team.json"),
                200,
            ),
            "*/set-piece-notes/" => Http::response(
                $this->loadFixture("set-piece-notes.json"),
                200,
            ),
        ]);
    }

    public function testItReturnsACollectionOfGeneralInfo()
    {
        $fpl = new FplClient();

        $generalInfo = $fpl->generalInfo();

        $this->assertIsIterable($generalInfo);
        $this->assertCount(8, $generalInfo);
    }

    public function testItReturnsACollectionOfAllFixtures()
    {
        $fpl = new FplClient();

        $fixtures = $fpl->allFixtures();

        $this->assertIsIterable($fixtures);
        $this->assertCount(380, $fixtures);
    }

    public function testItReturnsACollectionOfAllUpcomingFixtures()
    {
        $fpl = new FplClient();

        $fixtures = $fpl->allUpcomingFixtures();

        $this->assertIsIterable($fixtures);
        $this->assertCount(359, $fixtures);
    }

    public function testItReturnsACollectionOfSpecificGameweekFixtures()
    {
        $fpl = new FplClient();

        $firstGameweekFixtures = $fpl->gameweekFixtures();

        $this->assertIsIterable($firstGameweekFixtures);
        $this->assertCount(10, $firstGameweekFixtures);
    }

    public function testItReturnsPlayersDetailedData()
    {
        $fpl = new FplClient();

        $playersDetailedData = $fpl->playersDetailedData(4);

        $this->assertCount(3, $playersDetailedData);
    }

    public function testItReturnsGameweekLiveData()
    {
        $fpl = new FplClient();

        $playersDetailedData = $fpl->gameweekLiveData(4);

        $this->assertCount(1, $playersDetailedData);
    }

    public function testItReturnsManagersBasicInformation()
    {
        $fpl = new FplClient();

        $managerBasicInformation = $fpl->managerBasicInformation(58206);

        $this->assertIsArray($managerBasicInformation);
        $this->assertSame(58206, data_get($managerBasicInformation, "id"));
    }

    public function testItReturnsManagersHistory()
    {
        $fpl = new FplClient();

        $managerHistory = $fpl->managerHistory(58206);

        $this->assertIsArray($managerHistory);
        $this->assertArrayHasKey("current", $managerHistory);
        $this->assertArrayHasKey("past", $managerHistory);
    }

    public function testItReturnsClassicLeagueStandings()
    {
        $fpl = new FplClient();

        $league = $fpl->classicLeagueStandings(638);

        $this->assertIsArray($league);
        $this->assertArrayHasKey("league", $league);
        $this->assertArrayHasKey("standings", $league);
    }

    public function testItReturnsManagersTeamPerGameweek()
    {
        $fpl = new FplClient();

        $managersTeam = $fpl->managersTeam(58206, 2);

        $this->assertIsArray($managersTeam);
        $this->assertArrayHasKey("entry_history", $managersTeam);
        $this->assertArrayHasKey("picks", $managersTeam);
        $this->assertArrayHasKey("automatic_subs", $managersTeam);
        $this->assertArrayHasKey("active_chip", $managersTeam);
    }

    public function testItReturnsEventStatus()
    {
        $fpl = new FplClient();

        $eventStatus = $fpl->eventStatus();

        $this->assertIsArray($eventStatus);
        $this->assertArrayHasKey("status", $eventStatus);
        $this->assertArrayHasKey("leagues", $eventStatus);
    }

    public function testItReturnsDreamTeam()
    {
        $fpl = new FplClient();

        $dreamTeam = $fpl->dreamTeam(2);

        $this->assertIsArray($dreamTeam);
        $this->assertArrayHasKey("top_player", $dreamTeam);
        $this->assertArrayHasKey("team", $dreamTeam);
    }

    public function testItReturnSetPieceTakerNotes()
    {
        $fpl = new FplClient();

        $dreamTeam = $fpl->setPieceTakerNotes();

        $this->assertIsArray($dreamTeam);
        $this->assertArrayHasKey("last_updated", $dreamTeam);
        $this->assertArrayHasKey("teams", $dreamTeam);
    }

    protected function loadFixture(string $fileName): string
    {
        return file_get_contents(dirname(__DIR__) . "/tests/Fixtures/{$fileName}");
    }
}
