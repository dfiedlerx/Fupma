<?php

namespace pageNotFound;

use Engine;

class pageNotFoundController extends Engine\Controller
{
    public function index () {

        return $this->loadView('error404');
        
    }  
}

