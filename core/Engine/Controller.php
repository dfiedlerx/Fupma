<?php namespace Engine;

/* 
 * 
 * Classe que gerenciará as necessidades basicas do model.
 * 
 */


class Controller
{
    protected $view;

    public function __construct() {

        $this->view = new View();

    }

    /*
     * Chama página de visão para o sistema.
     */ 
    protected function loadView (string $viewName, array $viewData = array()) {

        if (file_exists(VIEWS_DIRECTORY . $viewName . VIEWS_COMPLEMENT.'.php')) {

            extract($viewData);
            include VIEWS_DIRECTORY . $viewName . VIEWS_COMPLEMENT . '.php';
            return true;

        }

        return false;

    }
    /*
     * Verifica se determinado parâmetro passado em uma url é um número.
     */
    protected function verifIfIsNumericParameter ($number) {

        $parameter = $number + 0;
        $parameter .= '';
        return $parameter === $number;

    }
    /*
     * Verifica se determinado parâmetro passado em uma url é um número inteiro.
     */   
    protected  function verifIfIsIntParameter ($number) {
		
        $parameter = $number;
        settype($parameter, "integer");  
        $parameter .= '';
        return
            $parameter === $number &&
            !strpos($number, array (',','.',';'));
		
    }

}
