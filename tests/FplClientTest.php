<?php

namespace Njaaazi\Fpl\Tests;

use Illuminate\Support\Facades\Http;
use Njaaazi\Fpl\FplClient;


class ExampleTest extends TestCase
{

    /** @test */
    public function it_returns_a_collection_of_general_info()
    {

        Http::fake([
            'https://fantasy.premierleague.com/api/bootstrap-static/'
            => Http::response(
                json_decode(file_get_contents('tests/stubs/bootstrap-static.json'), true),
                200
            )
        ]);

        $generalInfo = FplClient::generalInfo();

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
            )
        ]);

        $fixtures = FplClient::allFixtures();

        $this->assertIsIterable($fixtures);
        $this->assertCount(380, $fixtures);
    }
}


