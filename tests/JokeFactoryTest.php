<?php

namespace Zonec\Base\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;

/**
 *  JokesFactory test
 */
class JokesFactoryTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    function it_returns_a_random_joke()
    {
        $theJoke = "Chuck Norris' drinking habit has gotten to the point where he regularly eats several six-packs while waiting for the truckers to unload the kegs.";

        // Create a mock and queue two responses.
        $mock = new MockHandler([
            new Response(200, [], '{
                "categories": [],
                "created_at": "2016-05-01 10:51:41.584544",
                "icon_url": "https://assets.chucknorris.host/img/avatar/chuck-norris.png",
                "id": "sY9BZeKsSPKD0uKhtwrUZw",
                "updated_at": "2016-05-01 10:51:41.584544",
                "url": "https://api.chucknorris.io/jokes/sY9BZeKsSPKD0uKhtwrUZw",
                "value": "Chuck Norris\' drinking habit has gotten to the point where he regularly eats several six-packs while waiting for the truckers to unload the kegs."
            }')
        ]);

        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        $factory = new \Zonec\Base\JokesFactory($client);

        $randomJoke = $factory->getRandomJoke();

        $this->assertSame($randomJoke, $theJoke);
    }
}
?>
