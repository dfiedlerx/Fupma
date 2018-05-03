<?php namespace Controllers\WrongUrlFormat;


use Core\Engine\Controller;


/**
 * Class wrongUrlFormatController
 * @package wrongUrlFormat
 */
class WrongUrlFormatController extends Controller
{
    /**
     * @return bool
     */
    public function index (){

        return $this->loadView('wrongUrlFormat', 'index','index');

    }

}