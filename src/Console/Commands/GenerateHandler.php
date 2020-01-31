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
            return $this->error('Error, controller was not created');

        //HandlerInterface
        if (!$this->makeInterface($name))
            return $this->error('Error, interface was not created');

        //HandlerCore
        if (!$this->makeHandler($name))
            return $this->error('Error, handler was not created');

        //Model
        if (!$this->makeModel($name))
            return $this->error('Error, model was not created');

        //Request
        if (!$this->makeRequest($name))
            return $this->error('Error, request was not created');

        //Transformer
        if (!$this->makeTransformer($name))
            return $this->error('Error, transformer was not created');

        if (!$this->updatePatternConfig($name))
            return $this->error('Error, pattern config was not updated');


        return $this->info('Handler interface created');
    }








}
