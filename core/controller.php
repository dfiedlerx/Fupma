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
        include 'views/' . $viewName . VIEWS_COMPLEMENT.'.php';
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

}
