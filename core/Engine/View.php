<?php namespace Engine;
/**
 * Fupma
 *
 * Classe responsável por gerenciar algumas das funções primordiais
 * para views.
 *
 * 23/12/2017
 *
 */


class View {

    /*
        * Traz as depenências primordias Front-End do sistema automaticamente.
        */

    public function loadDefaultFrontDependences (string $viewName = '') {

        //Javascript Dependences

        //Jquery
        echo '<script src="',JS_DIRECTORY,JQUERY_VERSION,'"></script>';
        //Bootstrap
        echo '<script src="',JS_DIRECTORY,BOOTSTRAP_JS,'"></script>';

        //CSS Dependences

        //Bootstrap
        echo '<link rel="stylesheet" type="text/css" href="',CSS_DIRECTORY,BOOTSTRAP_CSS,'">';

        //Carrega os scripts particulares de uma página caso existam
        if (!empty ($viewName)) {

            if (file_exists(JS_DIRECTORY.$viewName.'/'.$viewName.'.js')){

                echo '<script src="',JS_DIRECTORY,$viewName,'/',$viewName,'.js"></script>';

            }

            if (file_exists(CSS_DIRECTORY.$viewName.'/'.$viewName.'.css')) {

                echo '<link rel="stylesheet" type="text/css" href="',CSS_DIRECTORY,$viewName,'/',$viewName,'.css">';

            }

        }

    }

    //Traz uma dependência de view independente
    public function loadSingularDependence (string $dependeceDirectory, string $fileName, string $typeDependence) {

        if (file_exists($dependeceDirectory.'/'.$fileName.$typeDependence)) {

            echo '<script src="',$dependeceDirectory,'/',$fileName,$typeDependence,'"></script>';

        }

    }

}