<?php namespace Core\Engine;
/**
 * Fupma
 *
 * Classe responsável por gerenciar algumas das funções primordiais
 * para Views.
 *
 * 23/12/2017
 *
 */

/**
 * Class View
 * @package Core\Engine
 * @author Daniel Fiedler
 */
class View {

    //Traz as depenências primordias Front-End do sistema automaticamente.
    public function loadDefaultFrontDependences () {

        /// Javascript ///

        //Jquery
        $this->loadJSDependence(JQUERY_VERSION_JS);
        //Tether
        $this->loadJSDependence(TETHER_JS);
        //Bootstrap JS
        $this->loadJSDependence(BOOTSTRAP_JS);

        /// CSS ///

        //Bootstrap CSS
        $this->loadCSSDependence(BOOTSTRAP_CSS);

    }

    /**
     * @param string $pathOfDependency
     * @param bool $isExternal
     */
    public function loadJSDependence(string $pathOfDependency, bool $isExternal = false) {

        echo
            '<script src="',
            (
                !$isExternal
                    ? JS_DIRECTORY.$pathOfDependency
                    : $pathOfDependency
            ),
            '.js"></script>';

    }

    /**
     * @param string $pathOfDependency
     * @param bool $isExternal
     */
    public function loadCSSDependence(string $pathOfDependency, bool $isExternal = false) {

        echo
            '<link rel="stylesheet" type="text/css" href="',
            (
                !$isExternal
                    ? CSS_DIRECTORY.$pathOfDependency
                    : $pathOfDependency
            ),
            '.css">';

    }


}