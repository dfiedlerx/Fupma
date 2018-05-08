<?php namespace System\Controllers\Home;


use Core\Engine\Controller;

/**
 * Class HomeController
 * @package System\Controllers\Home
 */
class HomeController extends Controller
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
