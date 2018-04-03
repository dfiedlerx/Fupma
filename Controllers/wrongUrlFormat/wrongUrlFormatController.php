<?php namespace Controllers\wrongUrlFormat;

use Core\Engine;

/**
 * Class wrongUrlFormatController
 * @package wrongUrlFormat
 */
class wrongUrlFormatController extends Engine\Controller
{
    /**
     * @return bool
     */
    public function index (){

        return $this->loadView('wrongUrlFormat', 'index','index');

    }

}