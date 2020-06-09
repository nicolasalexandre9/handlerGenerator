<?php

namespace Nicolasalexandre9\HandlerGenerator;

use Nicolasalexandre9\HandlerGenerator\Console\Commands\ControllerHandlerMakeCommand;
use Nicolasalexandre9\HandlerGenerator\Console\Commands\HandlerInterfaceMakeCommand;
use Nicolasalexandre9\HandlerGenerator\Console\Commands\HandlerMakeCommand;
use Nicolasalexandre9\HandlerGenerator\Console\Commands\TransformerMakeCommand;
use function Couchbase\defaultDecoder;
use Illuminate\Support\ServiceProvider;
use Nicolasalexandre9\HandlerGenerator\Console\Commands\GenerateHandler;

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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'handlerGenerator');

        if ($this->app->runningInConsole()) {
            $this->commands([
                GenerateHandler::class,
                HandlerInterfaceMakeCommand::class,
                HandlerMakeCommand::class,
                TransformerMakeCommand::class,
                ControllerHandlerMakeCommand::class
            ]);
        }
    }
}
