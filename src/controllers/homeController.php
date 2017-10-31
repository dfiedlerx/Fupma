<?php

class homeController extends controller
{
    
    public function index () {

        $this->loadView('index');  
        return true;

    }

}
