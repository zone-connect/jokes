<?php

namespace Zonec\Base\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Zonec\Base\Http\Controllers\RandomJokeController;

/**
 * JokesServiceProvider
 */
class JokesServiceProvider extends ServiceProvider
{

    /**
     * Boot methods are called after all service providers have been registered
     * Here is where we can start to use available services such as
     * - run migrations
     * - publish assets
     * - Load commands
     * - etc
     *
     * @return [type] [description]
     */
    public function boot()
    {
        // load views
        $this->loadViewsFrom(__DIR__. "/../../resources/views", "jokes-views");

        if ($this->app->runningInConsole()) {
            // To allow users to customize the views, will need to publish them
            $this->publishes([
                __DIR__. "/../../resources/views" => resource_path("views/vendor/jokes-views"),
                __DIR__. "/../../config/jokes.php" => base_path("config/jokes.php")
            ], "jokes.app");

            /**
             * If you want customers to modify migrations, publish it
             * ensure we are not recreating the same file over and over
             *
             * Uncomment below
             */
            // if (!class_exists('CreateJokesTable')) {
            //     $this->publishes([
            //     __DIR__. "/../../migrations/create_jokes_table.php" => database_path("migrations/" . date("Y_m_d_His", time()). "_create_jokes_table.php")
            //     ], "jokes.migrations");
            // }
        }

        Route::get(config("jokes.route"), RandomJokeController::class);
    }

    /**
     * Adds stuff to the IOC container
     *
     * @return [type] [description]
     */
    public function register()
    {
        # register our facade
        $this->app->bind("jokes-factory", function (){
            return new \Zonec\Base\JokesFactory();
        });

        // need to make our custom config file available - and make is available as "jokes"
        $this->mergeConfigFrom(__DIR__ . "/../../config/jokes.php", "jokes");

        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Zonec\Base\Console\JokesCommand::class,
                \Zonec\Base\Console\MigrateCommand::class
            ]);
        }
    }
}
