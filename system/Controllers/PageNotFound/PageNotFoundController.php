<?php namespace System\Controllers\PageNotFound;


use Core\Engine\Controller;


/**
 * Class PageNotFoundController
 * @package System\Controllers\PageNotFound
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

