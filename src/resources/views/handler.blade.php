<?php echo '<?php ' ?>

namespace App\Http\Handlers\Core;

use App\Http\Handlers\AbstractHandler;
use App\Http\Handlers\Interfaces\{{ucFirst($name)}}HandlerInterface;


class {{ucFirst($name)}}Handler extends AbstractHandler implements {{ucFirst($name)}}HandlerInterface
{

    public function handle(?array $parameters = null)
    {
        //ToDo
    }

}
