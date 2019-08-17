<?php

namespace Zonec\Base\Console;

/**
 * Facade class for JokesFactory class
 */
class JokesCommand extends \Illuminate\Console\Command
{
    /**
     * Signature of the command
     *
     * @var null
     */
    protected $signature = 'jokes:factory';

    /**
     * Description of the command
     *
     * @var null
     */
    protected $description = 'Jokes console <command>';

    public function handle()
    {
        $this->info(\Zonec\Base\Facades\JokesFactory::getRandomJoke());
    }
}
