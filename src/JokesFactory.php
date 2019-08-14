<?php
namespace Zc\Base;

/**
 * Jokes Class
 */
class JokesFactory
{
    /**
     * Default Jokes
     *
     * @var null
     */
    protected $jokes = [
        'Chuck Norris threw a grenade and killed 50 people, then it exploded.',
        'Death once had a near-Chuck-Norris experience.',
        'Chuck Norris can kill two stones with one bird.'
    ];


    function __construct(array $jokes = [])
    {
        if (count($jokes)) {
            $this->jokes = $jokes;
        }
    }

    public function getJokes()
    {
        return $this->jokes;
    }

    public function getRandomJoke()
    {
        return $this->jokes[array_rand($this->jokes)];
    }
}
?>
