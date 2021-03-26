<?php
namespace Nicolasalexandre9\HandlerGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

abstract class AbstractGeneratorCommand extends GeneratorCommand
{
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
                'dummyModel',
                'DummyCategory',
                'DummyPackage',
                'DummyAuthor',
                'DummyLicence',
                'DummyLink',
            ],
            [
                $rawName,
                strtolower($rawName),
                config('handlerGenerator.category'),
                config('handlerGenerator.package'),
                config('handlerGenerator.author'),
                config('handlerGenerator.license'),
                config('handlerGenerator.link'),
            ],
            parent::buildClass($name)
        );
    }
}

