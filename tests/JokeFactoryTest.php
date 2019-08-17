<?php

namespace Zonec\Base\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\MockHandler;
use Illuminate\Foundation\Testing\TestCase;

/**
 *  JokesFactory test
 */
class JokesFactoryTest extends TestCase
{

    use \Tests\CreatesApplication;
    use \Illuminate\Foundation\Testing\DatabaseTransactions;

    /** @test */
    public function it_tests_default_random_joke_route()
    {
        $this->withoutExceptionHandling();

        // Comment below if you DONT want to mock api call
        \Zonec\Base\Facades\JokesFactory::shouldReceive("getRandomJoke")
        ->once()
        ->andReturn('some joke');


        $this->get("/random-joke")
            ->assertViewIs("jokes-views::joke")
            ->assertViewHas("jokeKey")
            ->assertStatus(200);
    }

    /** @test */
    public function it_displays_a_joke_when_command_called()
    {
        // mock
        \Zonec\Base\Facades\JokesFactory::shouldReceive("getRandomJoke")
        ->once()
        ->andReturn('some joke');

        $this->artisan('jokes:factory')
         // ->expectsQuestion('What is your name?', 'Taylor Otwell')
         // ->expectsQuestion('Which language do you program in?', 'PHP')
         ->expectsOutput('some joke')
         ->assertExitCode(0);
    }

    /** @test */
    public function it_can_access_the_database()
    {
        $this->withoutExceptionHandling();

        $this->artisan('jokes:migrate')
            ->assertExitCode(0);

        $jokeStr = "What's the difference between an errection and a ferrari?";

        $jokeModel = new \Zonec\Base\Joke();

        $jokeModel->joke = $jokeStr;

        $jokeModel->save();

        $newJoke = \Zonec\Base\Joke::find($jokeModel->id);

        $this->assertSame($newJoke->joke, $jokeStr);
    }

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
