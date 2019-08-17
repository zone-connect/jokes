<?php

namespace Zonec\Base\Facades;

use \Illuminate\Support\Facades\Facade;

/**
 * Facade class for JokesFactory class
 */
class JokesFactory extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'jokes-factory';
    }
}
