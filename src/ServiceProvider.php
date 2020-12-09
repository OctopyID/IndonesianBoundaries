<?php

namespace Octopy\Indonesian\Boundaries;

use Octopy\Indonesian\Boundaries\Commands\CitySeedCommand;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Octopy\Indonesian\Boundaries\Commands\ProvinceSeedCommand;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     */
    public function register() : void
    {
        $this->commands([
            ProvinceSeedCommand::class,
            CitySeedCommand::class,
        ]);
    }

    /**
     * @return void
     */
    public function boot() : void
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'migrations');
    }
}