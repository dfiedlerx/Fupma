<?php namespace home;

use Engine;


class homeController extends Engine\Controller
{
    
    public function index () {

        return $this->loadView ('home','index','index');

    }
	
	public function template ($algo) {

		return
            $this->loadTemplate(

                'teste',
                'home',
                ['template'],
                ['template'],
                ['algo' => $algo]

            );
	
	}	

}
