<?php

class pageNotFoundController extends controller
{
    public function index () {

        return $this->loadView('error404');
        
    }  
}

