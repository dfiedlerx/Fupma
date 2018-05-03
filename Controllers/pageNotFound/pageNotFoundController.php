<?php namespace Controllers\pageNotFound;


use Core\Engine\Controller;


/**
 * Class pageNotFoundController
 * @package pageNotFound
 */
class pageNotFoundController extends Controller
{
    /**
     * @return bool
     */
    public function index () {

        return $this->loadView('pageNotFound', 'index','index');
        
    }  
}

