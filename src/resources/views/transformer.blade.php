<?php echo '<?php' ?>

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\{{ ucfirst($name) }};

class {{ucFirst($name)}}Transformer extends TransformerAbstract
{
    /**
     * @param {{ucFirst($name)}} ${{$name}}
     *
     * @return array
     */
    public function transform({{ucFirst($name)}} ${{$name}}): array
    {
        $values = [];

        return $values;
    }
}
