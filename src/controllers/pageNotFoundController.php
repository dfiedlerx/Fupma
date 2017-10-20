<?php

class pageNotFoundController extends controller{
    public function index(){
        $this->loadView('error404');
    }  
}

