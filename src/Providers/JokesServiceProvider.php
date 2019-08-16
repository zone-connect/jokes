<?php

namespace Zonec\Base\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * JokesServiceProvider
 */
class JokesServiceProvider extends ServiceProvider
{

    public function boot()
    {
        # code...
    }

    /**
     * Adds stuff to the IOC container
     *
     * @return [type] [description]
     */
    public function register()
    {
        # register our facade
        $this->app()->bind("jokes-factory", function (){
            return new \Zonec\Base\JokesFactory();
        });
    }
}
