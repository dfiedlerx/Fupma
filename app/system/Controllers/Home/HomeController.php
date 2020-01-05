<?php namespace System\Controllers\Home;


use Core\Engine\Controller;
use System\Models\Home\HomeMailer;
use System\Models\Tools\Basic\GlobalValue;

session_start();

/**
 * Class HomeController
 * @package System\Controllers\Home
 */
class HomeController extends Controller
{

    public function __construct() {

        parent::__construct();

    }

    /**
     * @return bool
     */
    public function index () {

        return $this->loadView ('home/home');

    }

}
