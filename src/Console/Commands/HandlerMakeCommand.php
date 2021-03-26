<?php

namespace Nicolasalexandre9\HandlerGenerator\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class HandlerMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:handler';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new handler';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Handler';

    /**
     * Build the class with the given name.
     *
     * @param string $name
     * @return string
     */
    protected function buildClass($name)
    {
        $rawName = $this->getNameInput();
        return str_replace(
            [
                'DummyModel',
                'DummyInterface',
            ],
            [
                $rawName,
                $this->getInterfaceName($rawName),
            ],
            parent::buildClass($name)
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
        $name = ltrim($name, '\\/').'Handler';

        $rootNamespace = $this->rootNamespace();

        if (Str::startsWith($name, $rootNamespace)) {
            return $name;
        }

        $name = str_replace('/', '\\', $name);

        return $this->getDefaultNamespace(trim($rootNamespace, '\\')).'\\'.$name;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub(): string
    {
        return __DIR__.'/stubs/handler.stub';
    }

    /**
     * @param string $name
     * @return string
     */
    protected function getInterfaceName(string $name): string
    {
        return $name.'HandlerInterface';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Handlers\Core';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions(): array
    {
        return [];
    }
}
