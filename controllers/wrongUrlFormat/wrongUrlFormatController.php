<?php
/**
 * Created by PhpStorm.
 * User: Developer5
 * Date: 28/12/2017
 * Time: 14:53
 */

namespace wrongUrlFormat;

use Engine;

class wrongUrlFormatController extends Engine\Controller
{

    public function index (){

        return $this->loadView('wrongUrlFormat');

    }

}