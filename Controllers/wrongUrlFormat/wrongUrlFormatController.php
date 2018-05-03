<?php namespace Controllers\wrongUrlFormat;


use Core\Engine\Controller;


/**
 * Class wrongUrlFormatController
 * @package wrongUrlFormat
 */
class wrongUrlFormatController extends Controller
{
    /**
     * @return bool
     */
    public function index (){

        return $this->loadView('wrongUrlFormat', 'index','index');

    }

}