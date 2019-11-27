<?php echo '<?php ' ?>


class {{ucFirst($name)}}Controller extends Controller {


    public function index({{ucFirst($name)}}HandlerInterface ${{$name}}Handler)
    {
        return ${{$name}}Handler->handle();
    }


}
