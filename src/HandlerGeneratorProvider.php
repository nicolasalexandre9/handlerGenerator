<?php

namespace Nicolasalexandre9\HandlerGenerator;

use Illuminate\Support\ServiceProvider;
use Nicolasalexandre9\HandlerGenerator\Commands\GenerateHandler;

/**
 * Class HandlerGeneratorProvider
 *
 * @category Laravel-boilerplate
 * @package  Laravel-boilerplate
 * @author   nicolas <nicolas.alexandre@creatic-agency.fr>
 * @license  GNU http://www.creatic-agency.fr/license
 * @link     http://www.creatic-agency.fr
 */
class HandlerGeneratorProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateHandler::class
            ]);
        }
    }
}
