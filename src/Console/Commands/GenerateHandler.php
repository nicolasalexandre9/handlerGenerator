<?php

namespace Nicolasalexandre9\HandlerGenerator\Console\Commands;

use Illuminate\Console\Command;
use Nicolasalexandre9\HandlerGenerator\Traits\FileHandler;


class GenerateHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:handler {name} {controllerPath?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    use FileHandler;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        //Controller
        if (!$this->makeController($name, $this->argument('controllerPath')))
            $this->error('Error, controller was not created');

        //HandlerInterface
        if (!$this->makeInterface($name))
            $this->error('Error, interface was not created');

        //HandlerCore
        if (!$this->makeHandler($name))
            $this->error('Error, handler was not created');

        //Model
        if (!$this->makeModel($name))
            $this->error('Error, model was not created');

    }








}
