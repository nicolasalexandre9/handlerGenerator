<?php

namespace Nicolasalexandre9\HandlerGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\View;

class GenerateHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:handler {name}';

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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
      $name = $this->argument('name');
      //Controller
      $controller = View::make('controller')->with(compact('name'))->render();
      $res = file_put_contents('app/Http/Controllers/'.ucfirst($name).'Controller.php', $controller);

      //HandlerInterface
        if (!file_exists('app/Http/Handlers/Interfaces')) {
            mkdir('app/Http/Handlers/Interfaces', 0755, true);
        }
      $handlerInterface = View::make('handlerInterface')->with(compact('name'))->render();
      file_put_contents('app/Http/Handlers/Interfaces/'.ucfirst($name).'HandlerInterface.php', $handlerInterface);

      //HandlerCore
        if (!file_exists('app/Http/Handlers/Core')) {
            mkdir('app/Http/Handlers/Core', 0755, true);
        }
        $handler = View::make('handler')->with(compact('name'))->render();
      file_put_contents('app/Http/Handlers/Core/'.ucfirst($name).'Handler.php', $handler);

      //Model
        if (!file_exists('app/Models')) {
            mkdir('app/Models', 0755, true);
        }
      $model = View::make('model')->with(compact('name'))->render();
      file_put_contents('app/Models/'.ucfirst($name).'.php', $model);

    }








}
