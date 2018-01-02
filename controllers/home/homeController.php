<?php namespace home;

use Engine;


class homeController extends Engine\Controller
{
    
    public function index () {

        return $this->loadView ('index');

    }
	
	public function template ($algo = null) {

		return $this->loadTemplate ('teste', 'templateTeste', array ('algo' => $algo, 'text' => 'Texto de exemplo dentro do template'));
	
	}	

}
