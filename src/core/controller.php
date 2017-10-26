<?php

/* 
 * 
 * Classe que gerenciará as necessidades basicas do model.
 * 
 */

class controller {

    /*
     * Chama página de visão para o sistema.
     */ 
    protected function loadView($viewName, $viewData = array()) {

        extract($viewData);
        include VIEWS_DIRECTORY . $viewName . VIEWS_COMPLEMENT.'.php';
    }
    /*
     * Verifica se determinado parâmetro passado em uma url é um número.
     */
    protected function verifIfIsNumericParameter($number){
        $parameter = $number + 0;
        $parameter .= '';
        return $parameter === $number;
    }
    /*
     * Verifica se determinado parâmetro passado em uma url é um número inteiro.
     */   
    protected  function verifIfIsIntParameter($number){
		
        $parameter = $number;
        settype($parameter, "integer");  
        $parameter .= '';
        return $parameter === $number;
		
    }

	/*
	* Traz as depenências primordias do sistema automaticamente.
	*/
	
	protected function loadFrontDependences () {

        //Javascript Dependences

        //Jquery
		echo '<script src="',JS_DIRECTORY,JQUERY_VERSION,'"></script>';
        //Bootstrap
        echo '<script src="',JS_DIRECTORY,BOOTSTRAP_JS,'"></script>';

        //CSS Dependences

        //Bootstrap
        echo '<link rel="stylesheet" type="text/css" href="',
        CSS_DIRECTORY,BOOTSTRAP_CSS,'">';
        echo '<link rel="stylesheet" type="text/css" href="',
        CSS_DIRECTORY,BOOTSTRAP_GRID,'">';
        echo '<link rel="stylesheet" type="text/css" href="',
        CSS_DIRECTORY,BOOTSTRAP_REBOOT,'">';

	}	
}
