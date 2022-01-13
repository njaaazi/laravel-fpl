<?php

namespace Njaaazi\Fpl\Tests;

use Illuminate\Support\Facades\Http;
use Njaaazi\Fpl\Facades\Fpl;

class FplClientTest extends TestCase
{
    /** @test */
    public function it_returns_a_collection_of_general_info()
    {
        Http::fake([
            'https://fantasy.premierleague.com/api/bootstrap-static/'
            => Http::response(
                json_decode(file_get_contents('tests/stubs/bootstrap-static.json'), true),
                200
            ),
        ]);

        $generalInfo = Fpl::generalInfo();

        $this->assertIsIterable($generalInfo);
        $this->assertCount(8, $generalInfo);
    }

    /** @test */
    public function it_returns_a_collection_of_all_fixtures()
    {
        Http::fake([
            'https://fantasy.premierleague.com/api/fixtures/'
            => Http::response(
                json_decode(file_get_contents('tests/stubs/fixtures.json'), true),
                200
            ),
        ]);

        $fixtures = Fpl::allFixtures();

        $this->assertIsIterable($fixtures);
        $this->assertCount(380, $fixtures);
    }

    /** @test */
    public function it_returns_a_collection_of_specific_gameweek_fixtures()
    {
        Http::fake([
            'https://fantasy.premierleague.com/api/fixtures/?event=1'
            => Http::response(
                json_decode(file_get_contents('tests/stubs/first-gameweek-fixtures.json'), true),
                200
            ),
        ]);

        $firstGameweekFixtures = Fpl::gameweekFixtures();

        $this->assertIsIterable($firstGameweekFixtures);
        $this->assertCount(10, $firstGameweekFixtures);
    }
}
