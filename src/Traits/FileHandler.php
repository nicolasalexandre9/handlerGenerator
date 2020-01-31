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
        $controller = View::make('handlerGenerator::controller')->with(compact('name', 'path'))->render();
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
        $filename = 'app/Models/'.ucfirst($name).'.php';
        if (!is_dir($directory) && !mkdir($directory) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
        $model = View::make('handlerGenerator::model')->with(compact('name'))->render();
        return !file_exists($filename) ? (bool)file_put_contents($filename, $model) : true;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function makeTransformer(string $name): bool
    {
        $directory = 'app/Transformers';
        $filename = 'app/Transformers/'.ucfirst($name).'Transformer.php';
        if (!is_dir($directory) && !mkdir($directory) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
        $transformer = View::make('handlerGenerator::transformer')->with(compact('name'))->render();
        return !file_exists($filename) ? (bool)file_put_contents($filename, $transformer) : true;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function makeRequest(string $name): bool
    {
        $directory = 'app/Http/Requests';
        $filename = 'app/Http/Requests/'.ucfirst($name).'Request.php';
        if (!is_dir($directory) && !mkdir($directory) && !is_dir($directory)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $directory));
        }
        $request = View::make('handlerGenerator::request')->with(compact('name'))->render();
        return !file_exists($filename) ? (bool)file_put_contents($filename, $request) : true;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function updatePatternConfig(string $name): bool
    {
        $pattern = config('pattern');
        $filename = config_path(). '/pattern.php';
        if (isset($pattern) && file_exists($filename)) {
            $pattern['App\\Http\\Handlers\\Interfaces\\'.ucfirst($name).'HandlerInterface'] = 'App\\Http\\Handlers\\Core\\'.ucfirst($name).'Handler';
            return (bool)file_put_contents($filename, '<?php return ' . var_export($pattern, true) . ';');
        } else {
            return false;
        }
    }

}
