<?php namespace home;

use Engine;
use Teste;

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


    public function teste () {

        $algo = (new Teste\Teste())->callTeste();

        return $this->loadView ('home', 'teste', 'teste', ['algo' => $algo]);

    }
}
