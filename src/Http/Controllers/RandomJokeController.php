<?php

namespace Zonec\Base\Http\Controllers;

/**
 * Facade class for JokesFactory class
 */
class RandomJokeController extends \Illuminate\Routing\Controller
{
    public function __invoke()
    {
        return view("jokes-views::joke", ["jokeKey" => \Zonec\Base\Facades\JokesFactory::getRandomJoke()]);
    }
}
