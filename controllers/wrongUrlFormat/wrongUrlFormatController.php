<?php namespace wrongUrlFormat;

use Engine;


class wrongUrlFormatController extends Engine\Controller
{

    public function index (){

        return $this->loadView('wrongUrlFormat');

    }

}