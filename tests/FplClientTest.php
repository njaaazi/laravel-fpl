<?php

declare(strict_types=1);

namespace Njaaazi\Fpl\Tests;

use Njaaazi\Fpl\Facades\Fpl;
use Illuminate\Support\Facades\Http;

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
            "*/fixtures/?event=1" => Http::response(
                $this->loadFixture("first-gameweek-fixtures.json"),
                200,
            ),
        ]);
    }

    public function testItReturnsACollectionOfGeneralInfo()
    {
        $generalInfo = Fpl::generalInfo();

        $this->assertIsIterable($generalInfo);
        $this->assertCount(8, $generalInfo);
    }

    public function testItReturnsACollectionOfAllFixtures()
    {
        $fixtures = Fpl::allFixtures();

        $this->assertIsIterable($fixtures);
        $this->assertCount(380, $fixtures);
    }

    public function testItReturnsACollectionOfSpecificGameweekFixtures()
    {
        $firstGameweekFixtures = Fpl::gameweekFixtures();

        $this->assertIsIterable($firstGameweekFixtures);
        $this->assertCount(10, $firstGameweekFixtures);
    }

    protected function loadFixture(string $fileName): string
    {
        return file_get_contents(dirname(__DIR__) . "/tests/Fixtures/{$fileName}");
    }
}
