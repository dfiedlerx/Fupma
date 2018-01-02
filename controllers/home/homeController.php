<?php namespace home;

use Engine;


class homeController extends Engine\Controller
{
    
    public function index () {

        return $this->loadView ('index');

    }
	
	public function template ($algo) {

		return $this->loadTemplate ('teste', ['templateTeste'], array ('algo' => $algo));
	
	}	

}
