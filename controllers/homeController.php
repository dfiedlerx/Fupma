<?php

class homeController extends controller
{
    
    public function index () {

        return $this->loadView('index');

    }

}
