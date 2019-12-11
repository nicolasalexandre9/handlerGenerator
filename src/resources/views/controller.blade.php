<?php echo '<?php ' ?>

namespace App\Http\Controllers;

use App\Http\Handlers\Interfaces\{{ucFirst($name)}}HandlerInterface;

class {{ucFirst($name)}}Controller extends Controller
{

    /**
     * @param {{ucFirst($name)}}HandlerInterface ${{$name}}Handler
     *
     * @return array
     */
    public function index({{ucFirst($name)}}HandlerInterface ${{$name}}Handler): array
    {
        return ${{$name}}Handler->list();
    }

    /**
     * @param {{ucFirst($name)}}HandlerInterface ${{$name}}Handler
     *
     * @return array
     */
    public function store({{ucFirst($name)}}HandlerInterface ${{$name}}Handler): array
    {
        return ${{$name}}Handler->handle();
    }

    /**
     * @param int                       ${{$name}}
     * @param {{ucFirst($name)}}HandlerInterface ${{$name}}Handler
     *
     * @return array
     */
    public function show(int ${{$name}}, {{ucFirst($name)}}HandlerInterface ${{$name}}Handler): array
    {
        return ${{$name}}Handler->get(${{$name}});
    }

    /**
     * @param int                       ${{$name}}
     * @param {{ucFirst($name)}}HandlerInterface ${{$name}}Handler
     *
     * @return array
     */
    public function update(int ${{$name}}, {{ucFirst($name)}}HandlerInterface ${{$name}}Handler): array
    {
        return ${{$name}}Handler->handle(['id' => ${{$name}}]);
    }
}
