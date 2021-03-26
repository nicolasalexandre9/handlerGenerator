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
     * @param string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $rawName = $this->getNameInput();
        $stub = $this->replaceExtends(
            parent::buildClass($name),
            $this->option('child') ? $name : null
        );

        return str_replace(
            [
                'DummyModel',
                'DummyModelHandlerInterface',
                'DummyType',
                'dummyModel',
            ],
            [
                $rawName,
                $this->getInterfaceName($rawName),
                $this->option('type') ? 'abstract ' : '',
                strtolower($rawName),
            ],
            $stub
        );
    }

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param string $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim(Str::plural($name), '\\/') . 'Controller';

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')) . '\\' . $name;
    }

    /**
     * Get the destination class path.
     *
     * @param string $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::plural($this->getNameInput()) . 'Controller';
        $abstract = $this->option('type') ? 'Abstract' : '';
        $child = $this->option('child') ?: '';
        if (empty($abstract)) {
            $name = '\Http\Controllers\Api\\' . strtoupper(env('API_VERSION')) . '\\' . $child . '\\' . $name;
        } else {
            $name = '\Http\Controllers\Api\\' . strtoupper(env('API_VERSION')) . '\\' . $abstract . $name;
        }
        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . '.php';
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__ . '/stubs/controller.stub';
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getInterfaceName(string $name): string
    {
        return 'App\Http\Handlers\Interfaces\\' . $name . 'HandlerInterface';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        $namespace = $rootNamespace . '\Http\Controllers\Api\\' . strtoupper(env('API_VERSION'));
        return $this->option('child') ? $namespace . '\\' . $this->option('child') : $namespace;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        $abstract = $this->option('type') ? 'Abstract' : '';
        $class = $abstract . str_replace($this->getNamespace($name).'\\', '', $name);

        return str_replace(['DummyClass', '{{ class }}', '{{class}}'], $class, $stub);
    }

    /**
     * @param $stub
     * @param string|null $name
     * @return string
     */
    protected function replaceExtends($stub, ?string $name = null): string
    {
        $class = 'ApiController';
        if ($name && $this->option('child')) {
            $class = 'Abstract' . str_replace($this->getNamespace($name).'\\', '', $name);
            $use = 'use App\Http\Controllers\Api\\' . strtoupper(env('API_VERSION')) . '\\' . $class . ';';
            $stub = str_replace('DummyUseExtends', $use, $stub);
        }
        $stub = str_replace('DummyUseExtends', '', $stub);

        return str_replace('DummyExtends', $class, $stub);
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [
            ['type', 't', InputOption::VALUE_OPTIONAL, 'create abstract Controller'],
            ['child', 'c', InputOption::VALUE_OPTIONAL, 'child namespace'],
        ];
    }
}
