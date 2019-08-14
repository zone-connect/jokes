<?php

namespace Zc\Base\Tests;

/**
 *  JokesFactory test
 */
class JokesFactoryTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    function it_returns_a_random_joke()
    {
        $factory = new \Zc\Base\JokesFactory();

        $jokes = $factory->getJokes();

        $randomJoke = $factory->getRandomJoke();

        $this->assertContains($randomJoke, $jokes);
    }
}
?>
