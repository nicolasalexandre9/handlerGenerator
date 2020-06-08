<?php

namespace Nicolasalexandre9\HandlerGenerator\Console\Commands;

use Illuminate\Console\Command;
use Nicolasalexandre9\HandlerGenerator\Traits\FileHandler;

/**
 * Class GenerateHandler
 *
 * @category HandlerGenerator
 * @package  HandlerGenerator
 * @author   nicolas <nicolas.alexandre@creatic-agency.fr>
 * @license  GNU http://www.creatic-agency.fr/license
 * @link     http://www.creatic-agency.fr
 */
class GenerateHandler extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:handler {name} {entities?*}';

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
        $name = ucfirst($this->argument('name'));
        $childEntities = $this->argument('entities');

        //Controller
        if (empty($childEntities)) {
            $this->call('make:controllerHandler', [
                'name' => $name,
            ]);
        } else {
            $this->call('make:controllerHandler', [
                'name' => $name,
                '--type' => 'abstract'
            ]);
            foreach ($childEntities as $entity) {
                $this->call('make:controllerHandler', [
                    'name' => $name,
                    '--child' => $entity
                ]);
            }
        }

        //HandlerInterface
        $this->call('make:handlerInterface', [
            'name' => $name,
        ]);

        //HandlerCore
        $this->call('make:handler', [
            'name' => $name,
        ]);

        //Model
        $this->call('make:model', [
            'name' => $name,
        ]);

        //Request
        $this->call('make:request', [
            'name' => $name . 'Request',
        ]);

        //Transformer
        $this->call('make:transformer', [
            'name' => $name,
        ]);

        if (!$this->updatePatternConfig($name))
            return $this->error('Error, pattern config was not updated');


        return $this->info('Handler interface created');
    }
}
