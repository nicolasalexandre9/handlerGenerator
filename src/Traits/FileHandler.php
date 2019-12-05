<?php

namespace Nicolasalexandre9\HandlerGenerator\Traits;

use Illuminate\Support\Facades\View;

trait FileHandler
{

    /**
     * @param string      $name
     * @param string|null $path
     *
     * @return bool
     */
    public function makeController(string $name, ?string $path): bool
    {
        $controllerPath = 'app/Http/Controllers/'.$path;
        $filename = $controllerPath.ucfirst($name).'Controller.php';
        $controller = View::make('handlerGenerator::controller')->with(compact('name'))->render();
        return !file_exists($filename) ? (bool)file_put_contents($filename, $controller) : true;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function makeInterface(string $name): bool
    {
        $directory = 'app/Http/Handlers/Interfaces';
        $filename = 'app/Http/Handlers/Interfaces/'.ucfirst($name).'HandlerInterface.php';
        if (!is_dir($directory) && !mkdir($directory) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
        $handlerInterface = View::make('handlerGenerator::handlerInterface')->with(compact('name'))->render();
        return !file_exists($filename) ? (bool)file_put_contents($filename, $handlerInterface) : true;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function makeHandler(string $name): bool
    {
        $directory = 'app/Http/Handlers/Core';
        $filename = 'app/Http/Handlers/Core/'.ucfirst($name).'Handler.php';
        if (!is_dir($directory) && !mkdir($directory) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
        $handler = View::make('handlerGenerator::handler')->with(compact('name'))->render();
        return !file_exists($filename) ? (bool)file_put_contents($filename, $handler) : true;

    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function makeModel(string $name): bool
    {
        $directory = 'app/Models';
        $filename = 'app/Models/';
        if (!is_dir($directory) && !mkdir($directory) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
        $model = View::make('handlerGenerator::model')->with(compact('name'))->render();
        return !file_exists($filename) ? (bool)file_put_contents($filename, $model) : true;

    }

}
