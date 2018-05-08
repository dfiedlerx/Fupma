<?php namespace System\Controllers\WrongUrlFormat;


use Core\Engine\Controller;


/**
 * Class WrongUrlFormatController
 * @package System\Controllers\WrongUrlFormat
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