<?php echo '<?php ' ?>

namespace App\Http\Handlers\Core;

use App\Http\Handlers\AbstractHandler;
use App\Http\Handlers\Interfaces\{{ucFirst($name)}}HandlerInterface;


class {{ucFirst($name)}}Handler extends AbstractHandler implements {{ucFirst($name)}}HandlerInterface
{

    /**
     * @param array $parameters
     *
     * @return array
     */
    public function handle(array $parameters = []): array
    {
        //ToDo
    }
}
