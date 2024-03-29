<?php

namespace Nicolasalexandre9\HandlerGenerator\Console\Commands;

use Illuminate\Console\Command;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class HandlerInterfaceMakeCommand
 *
 * @category HandlerGenerator
 * @package  HandlerGenerator
 * @author   nicolas <nicolas.alexandre@creatic-agency.fr>
 * @license  GNU http://www.creatic-agency.fr/license
 * @link     http://www.creatic-agency.fr
 */
class HandlerInterfaceMakeCommand extends AbstractGeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:handlerInterface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new handler interface';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'HandlerInterface';

    /**
     * Parse the class name and format according to the root namespace.
     *
     * @param string $name
     * @return string
     */
    protected function qualifyClass($name)
    {
        $name = ltrim($name, '\\/').'HandlerInterface';

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
        return __DIR__.'/stubs/interface.stub';
    }


    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace.'\Http\Handlers\Interfaces';
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
