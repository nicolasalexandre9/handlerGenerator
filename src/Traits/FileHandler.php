<?php

namespace Nicolasalexandre9\HandlerGenerator\Traits;

use Illuminate\Support\Facades\View;

/**
 * Trait FileHandler
 * @category HandlerGenerator
 * @package  HandlerGenerator
 * @author   nicolas <nicolas.alexandre@creatic-agency.fr>
 * @license  GNU http://www.creatic-agency.fr/license
 * @link     http://www.creatic-agency.fr
 */
trait FileHandler
{
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
