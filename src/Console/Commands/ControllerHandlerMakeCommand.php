<?php

namespace Nicolasalexandre9\HandlerGenerator\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ControllerHandlerMakeCommand
 *
 * @category HandlerGenerator
 * @package  HandlerGenerator
 * @author   nicolas <nicolas.alexandre@creatic-agency.fr>
 * @license  GNU http://www.creatic-agency.fr/license
 * @link     http://www.creatic-agency.fr
 */
class ControllerHandlerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:controllerHandler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new controller';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Controller';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $rawName = $this->getNameInput();
        return str_replace(
            [
                'DummyModel',
                'DummyModelInterface',
                'DummyType',
                'dummyModel'
            ],
            [
                $rawName,
                $this->getInterfaceName($rawName),
                $this->option('type') ? 'abstract ' :  '',
                strtolower($rawName)
            ],
            parent::buildClass($name)
        );
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param  string  $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim(Str::plural($name), '\\/').'Controller';

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name;
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::plural($this->getNameInput()) . 'Controller';
        $abstract = $this->option('type') ? 'Abstract' :  '';
        $child = $this->option('child') ?: '';
        if (empty($abstract)) {
            $name = '\Http\Controllers\Api\\' . strtoupper(env('API_VERSION')) . '\\' . $child . '\\' . $name;
        } else {
            $name = '\Http\Controllers\Api\\' . strtoupper(env('API_VERSION')) . '\\' . $abstract . $name;
        }
        return $this->laravel['path'].'/'.str_replace('\\', '/', $name).'.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__.'/stubs/controller.stub';
    }

    protected function getInterfaceName($name)
    {
        return 'App\Http\Handlers\Interfaces\\' . $name . 'HandlerInterface';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $rootNamespace.'\Http\Controllers\Api\\' . strtoupper(env('API_VERSION'));
        return  $this->option('child') ? $namespace . '\\' . $this->option('child') : $namespace;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['type', 't', InputOption::VALUE_OPTIONAL, 'create abstract Controller'],
            ['child', 'c', InputOption::VALUE_OPTIONAL, 'child namespace'],
        ];
    }
}
