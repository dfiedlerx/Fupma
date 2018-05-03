<?php namespace Controllers\PageNotFound;


use Core\Engine\Controller;


/**
 * Class pageNotFoundController
 * @package pageNotFound
 */
class PageNotFoundController extends Controller
{
    /**
     * @return bool
     */
    public function index () {

        return $this->loadView('pageNotFound', 'index','index');
        
    }  
}

