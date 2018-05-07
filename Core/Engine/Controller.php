<?php namespace Core\Engine;

/* 
 * 
 * Classe que gerenciará as necessidades basicas do model.
 * 
 */

/**
 * Class Controller
 * @package Engine
 * @author Daniel Fiedler
 */
class Controller
{

    protected $view;

    public function __construct() {

        $this->view = new View();

    }

    /**
     * Chama página de visão para o sistema.
     * @param string $controllerName
     * @param string $actionName
     * @param string $viewName
     * @param array $viewData
     * @return bool
     */
    protected function loadView (string $controllerName, string $actionName, string $viewName, array $viewData = []) {

        if (file_exists(VIEWS_DIRECTORY . $controllerName . '/' . $actionName . '/' . $viewName . VIEWS_COMPLEMENT . '.php')) {

            include VIEWS_DIRECTORY . $controllerName . '/' . $actionName. '/' . $viewName . VIEWS_COMPLEMENT . '.php';
            return true;

        }

        return false;

    }

    /**
     * @param string $templateName
     * @param string $controllerName
     * @param array $actionNames
     * @param array $viewsNames
     * @param array $viewData
     * @return bool
     */
    protected function loadTemplate (string $templateName,
                                     string $controllerName,
                                     array $actionNames,
                                     array  $viewsNames,
                                     array $viewData = []) {

        if (file_exists(TEMPLATES_DIRECTORY . $templateName . TEMPLATES_COMPLEMENT . '.php')) {

            include TEMPLATES_DIRECTORY  . $templateName . TEMPLATES_COMPLEMENT . '.php';
            return true;

        }

        return false;

    }

    /**
     * Verifica se determinado parâmetro passado em uma url é um número.
     * @param string $number
     * @param bool $allowDotInFinal
     * @return bool
     */
    protected function verifIfIsNumericParameter (string $number, bool $allowDotInFinal = false) : bool {

        return is_numeric($number) && ($allowDotInFinal || (!$allowDotInFinal && $number[strlen($number) - 1] != '.'));

    }

    /**
     * Verifica se determinado parâmetro passado em uma url é um número inteiro.
     * @param $number
     * @return bool
     */
    protected function verifIfIsIntParameter (string $number) : bool {

        return is_numeric($number) && !strpos($number, '.');

    }

    /**
     * Verifica se determinado parametro é numerico e decimal
     * @param string $number
     * @return bool
     */
    protected function verifIfIsDecimalParameter (string $number) : bool {

        return is_numeric ($number) && strpos($number, '.');

    }

}
