<?php

class homeController extends controller{
    
    public function index () {

        $this->loadView('index');
        return TRUE;

    }

    public function index2 () {

        echo "Hello World 2";
        return TRUE;

    }
}
