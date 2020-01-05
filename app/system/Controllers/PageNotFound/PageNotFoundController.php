<?php namespace System\Controllers\PageNotFound;


use Core\Engine\Controller;

class PageNotFoundController extends Controller
{


    public function index () {

       echo 'A página solicitada não existe';
       return true;

    }

}