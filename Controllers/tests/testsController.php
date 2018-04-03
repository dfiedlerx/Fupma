<?php namespace Controllers\tests;


use Core\Engine\Controller;
use Core\Tools\ModelTools as Tools;

/**
 * Created by PhpStorm.
 * User: Developer5
 * Date: 16/02/2018
 * Time: 17:34
 */

class testsController extends Controller
{

    public function index () {

        echo 'This page is a test place to validade class methods';

    }


    public function arrayTools () {

        $array = ['A' => 'AAAAAA', 'B' => 'AAAAAA', 'C' => 'AAAAAA', 'D' => 'AAAAAA'
            , 'E' => 'AAAAAA', 'F' => null, 'G' => null, 'H' => 'AAAAAA', 'I' => null, 'J'  => 'AAAAAA'];

        var_dump(Tools\ArrayTools::isAExistsKeys($array,['A', 'B', 'F']));
        var_dump(Tools\ArrayTools::isAExistsKeys($array,['A', 'B', 'F'], false));
        var_dump(Tools\ArrayTools::countArray($array));
        var_dump(Tools\ArrayTools::countArray($array, true));
        var_dump(Tools\ArrayTools::organizeValuesWithNumbers($array));
        var_dump(Tools\ArrayTools::arrayTermExists($array, 'AAAAAA'));
        var_dump(Tools\ArrayTools::arrayTermExists($array, 'AAAAAa'));

        return true;

    }

    public function cookie () {

        Tools\Cookie::setCookie('cookieDeTeste', 'contentDeTeste');
        var_dump(Tools\Cookie::searchCookie('cookieDeTeste'));
        var_dump(Tools\Cookie::readCookie('cookieDeTeste'));
        Tools\Cookie::deleteCookie('cookieDeTeste');
        var_dump(Tools\Cookie::readCookie('cookieDeTeste'));
        var_dump(Tools\Cookie::searchCookie('cookieDeTeste'));

        return true;

    }

    public function crypto () {

        var_dump(Tools\Crypto::passwordHashGenerator('fsdkljfhskdjfhks jfhskdjfs'));
        var_dump(Tools\Crypto::hashComparer('fsdkljfhskdjfhks jfhskdjfs', '$2a$08$887c9ecbbb20bc543fb44uYVB4QxSLxAT7Ve0/fIkeicEWNUdSOuq'));
        var_dump(Tools\Crypto::systemHashGenerator());
        return true;

    }

    public function dateTimeTools () {

        var_dump(Tools\DateTimeTools::convertDateFormat('2017-01-05 05:05:05', 'd/m/Y H:i:s'));
        var_dump(Tools\DateTimeTools::dateAcress('2017-01-05 05:05:05', '+8 days'));
        return true;

    }

}