<?php namespace System\Controllers\Login;


use Core\Engine\Controller;

session_start();

class LoginController extends Controller
{

    public function index() {

        echo 'Login';
        return true;

    }

}