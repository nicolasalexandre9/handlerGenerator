<?php echo '<?php' ?>

namespace App\Http\Handlers\Core;

use App\Http\Handlers\AbstractHandler;
use App\Http\Handlers\Interfaces\{{ucFirst($name)}}HandlerInterface;
use Illuminate\Http\Request;
use App\Models\{{ ucfirst($name) }};

class {{ucFirst($name)}}Handler extends AbstractHandler implements {{ucFirst($name)}}HandlerInterface
{

    /**
     * @param Request $request
     *
     * @throws \ReflectionException
     */
    public function __construct(Request $request)
    {
        parent::__construct($request, {{ ucfirst($name) }}::class);
    }

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
