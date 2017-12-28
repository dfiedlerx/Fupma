<?php

/* 
 * 
 * Classe que gerenciará as necessidades basicas do model.
 * 
 */

namespace Engine;

class Core
{

    private $currentController;
    private $currentAction;
    private $urlParameters;

    public function run () {

        $this->urlParameters = str_replace( 

            SYSTEM_DIRECTORY, 
            '',
            filter_var ($_SERVER ['REQUEST_URI'], FILTER_SANITIZE_URL)

        );

        $this->makeParametersArray ();
        $this->setControllerAndAction ();
        $this->setAditionalParameters ();
        $this->callControllerAndAction ();

    }

    /*
     * Método que irá destrinchar a urlParameters e obtera o Controller e a action em um array.
     */

    private function makeParametersArray () {

        $this->urlParameters = explode('/', $this->urlParameters);

        //Caso o link padrão seja o diretório raiz do sistema
        if (empty($this->urlParameters[0])) {

            $this->removeFirstParameter ();

        }

    }
    
    /*
     * Método que irá atribuir os valores corretos para $currentController e  
     * $currentAction;
     * 
     */

    private function setControllerAndAction () {

        if (!empty ($this->urlParameters[0])) {

            $this->currentController = $this->urlParameters['0'] . '\\' . $this->urlParameters['0'] . CONTROLLERS_COMPLEMENT;
            $this->removeFirstParameter ();
            $this->setAction ();

        } else {

            $this->defaultController ();
            $this->defaultAction ();

        }

    }

    /*
     * Função que ira gerenciar qual action será chamada.
     */

    private function setAction () {

        if (!empty($this->urlParameters['0'])) {

            $this->personalizedAction ();

        } else {

            $this->defaultAction ();

        }

    }

    /*
     * Remove o primeiro parametro do array.
     *
     */

    private function removeFirstParameter () {

        array_shift($this->urlParameters);

    }

    /*
     *  Remove o ultimo parâmetro do array
     * 
     */

    private function removeLastParameter () {

        array_pop($this->urlParameters);

    }

    //Atribui o valor personalziado de um parâmetro para a action;
    private function personalizedAction () {

        $this->currentAction = $this->urlParameters[0];
        $this->removeFirstParameter ();

    }

    /*
     * Função que removerá possíveis parametros vazios que poderão ser passados
     * na url como por exemplo. Makroup.com//////home/index////////
     * 
     */

    private function setAditionalParameters () {

        $aditionalParametersQuantity = count($this->urlParameters);

        if (isset ($this->urlParameters['0']) && empty($this->urlParameters[0])) {

            $this->removeFirstParameter ();

        } else if 
            (

            isset ($this->urlParameters[$aditionalParametersQuantity - 1]) 
            && 
            empty($this->urlParameters[$aditionalParametersQuantity - 1])

            ) {

            $this->removeLastParameter ();

        }

    }

    /*
     * Seta o Controller Padrão;
     * 
     */

    private function defaultController() {

        $this->currentController = DEFAULT_CONTROLLER . '\\' .DEFAULT_CONTROLLER . CONTROLLERS_COMPLEMENT;

    }

    /*
     * Seta a action como padrão;
     *
     *      */

    private function defaultAction() {

        $this->currentAction = DEFAULT_ACTION . ACTION_COMPLEMENT;

    }
    
    /*
     * Faz a chamada das classes correspondetes de controller e view.
     */

    private function callControllerAndAction () {

        //Caso o Controller e a Action existam.
        if (method_exists($this->currentController, $this->currentAction) && $this->validateNumberOfParams()) {

            $callController = new $this->currentController ();

            if (!call_user_func_array (array($callController, $this->currentAction), $this->urlParameters)) {

                $this->notFoundPage ();

            }

        }

        //Caso o Controller ou a Action não forem encontrados.
        else {

            $this->notFoundPage ();

        }

    }

    /*
     * Função que valida se o numero de argumentos passados é igual ao da action em questão.
     * É uma função totalmente maleavel e se adapta a qualquer actopn.
     */

    private function validateNumberOfParams () {

        $methodArguments = new \ReflectionMethod ($this->currentController, $this->currentAction);
        $numberOfUrlParameters = count($this->urlParameters);

        //Caso o numero de parametros seja >= ao numero de parametros obrigatorios e <= ao numero de parametros no total
        return $numberOfUrlParameters >= $methodArguments->getNumberOfRequiredParameters ()     
               && 
               $numberOfUrlParameters <= $methodArguments->getNumberOfParameters ();

    }


    /*
     * Chama uma página informando que o conteudo não foi encontrado.
     * 
     */

    private function notFoundPage () {

        $controllerConstant = 'pageNotFound\pageNotFound' . CONTROLLERS_COMPLEMENT;
        return (new $controllerConstant())->index();
    
    }

}
