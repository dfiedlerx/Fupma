<?php namespace pageNotFound;

use Engine;

/**
 * Class pageNotFoundController
 * @package pageNotFound
 */
class pageNotFoundController extends Engine\Controller
{
    /**
     * @return bool
     */
    public function index () {

        return $this->loadView('pageNotFound', 'index','index');
        
    }  
}

