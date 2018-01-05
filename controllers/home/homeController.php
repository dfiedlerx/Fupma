<?php namespace home;

use Engine;


class homeController extends Engine\Controller
{
    /**
     * @return bool
     */
    public function index () {

        return $this->loadView ('home','index','index');

    }

    /**
     * @param $algo
     * @return bool
     */
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
