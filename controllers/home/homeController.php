<?php namespace home;

use Engine;


class homeController extends Engine\Controller
{
    
    public function index () {

        return $this->loadTemplate ('teste', 'index');

    }

}
