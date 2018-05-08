<?php namespace Core\Engine;

/* 
 * 
 * Classe que gerenciará o roteamento e leitura de URLs.
 * Ela procura respectivamente uma classe do tipo Controller que possua o mesmo nome e metodo dos parâmetros passados.
 * Também seta os valores adicionais caso sejam passadas.
 * Ex:
 *  www.site.com/user/new
 *  - Será procurado um controller de nome UserController e dentro dele o método new()
 *  www.site.com/user/new/param1/param2
 *  - O mesmo acima porém serão passados os parametros param1 e param2 no método new()
 *
 * Esta classe retornará o controller NotFoundController caso:
 *  - Não exista o controller ou action passados na url
 *  - Caso a quantidade de parametros adicionais sejam diferentes dos requeridos;
 *  - Caso os parametros passados sejam maiores que os parametros totais da action;
 *  - Caso a action retorne false por algum motivo.
 * 
 */

use System\Models\Tools\Basic\Filter;
use ReflectionMethod;


/**
 * Class Core
 * @package Core\Engine
 * @author Daniel Fiedler
 */
class Core
{

    private $currentController;
    private $currentAction;
    private $urlParameters;

    public function run () {

        $this->urlParameters = str_replace
        (

            SYSTEM_DIRECTORY, 
            '',
            Filter::internalFilter($_SERVER ['REQUEST_URI'], FILTER_SANITIZE_URL)

        );

        $this->makeParametersArray();
        $this->setControllerAndAction();
        $this->filterAditionalParameters();
        $this->callControllerAndAction();

    }

    /*
     * Método que irá destrinchar a urlParameters e obtera o Controller e a action em um array.
     */
    private function makeParametersArray () {

        $this->urlParameters = explode('/', $this->urlParameters);

        //Caso o link padrão seja o diretório raiz do sistema
        if ($this->paramExistsAndIsEmpty(0)) {

            $this->removeFirstParameter();

        }

    }
    
    /*
     * Método que irá atribuir os valores corretos para $currentController e  
     * $currentAction;
     * 
     */
    private function setControllerAndAction () {

        if (!empty ($this->urlParameters[0])) {

            $this->currentController =
                  CONTROLLERS_ROUTE
                  . $this->urlParameters['0']
                  . '\\' . $this->urlParameters['0']
                  . CONTROLLERS_COMPLEMENT;

            $this->removeFirstParameter();
            $this->setAction();

        } else {

            $this->defaultController();
            $this->defaultAction();

        }

    }

    /*
     * Função que ira gerenciar qual action será chamada.
     */
    private function setAction () : bool {

        return
            !empty($this->urlParameters['0'])
                ? $this->personalizedAction()
                : $this->defaultAction();

    }

    /*
     * Remove o primeiro parametro do array.
     *
     */
    private function removeFirstParameter () {

        return array_shift($this->urlParameters);

    }

    /*
     *  Remove o ultimo parâmetro do array
     * 
     */
    private function removeLastParameter () {

        return array_pop($this->urlParameters);

    }

    //Atribui o valor personalizado de um parâmetro para a action;
    private function personalizedAction () {

        $this->currentAction = $this->urlParameters[0];
        return $this->removeFirstParameter();

    }

    /**
     * Função que removerá possíveis parametros vazios que poderão ser passados
     * na url como por exemplo. Makroup.com//////home/index////////
     * 
     */
    private function filterAditionalParameters () {

        $aditionalParametersQuantity = count($this->urlParameters);

        if ($this->paramExistsAndIsEmpty(0)) {

            $this->removeFirstParameter();

        } else if ($this->paramExistsAndIsEmpty($aditionalParametersQuantity - 1)) {

            $this->removeLastParameter();

        }

    }

    /**
     * Verifica se o elemento no indice passado existe e não é nulo ou uma string vazia
     * @param int $paramIndex
     * @return bool
     */
    private function paramExistsAndIsEmpty (int $paramIndex) : bool {

        return
            isset ($this->urlParameters[$paramIndex]) &&
            ($this->urlParameters[$paramIndex] == '' || is_null($this->urlParameters[$paramIndex]));

    }

    //Seta o Controller Padrão
    private function defaultController () {

        $this->currentController = CONTROLLERS_ROUTE . DEFAULT_CONTROLLER . '\\' .DEFAULT_CONTROLLER . CONTROLLERS_COMPLEMENT;

    }

    //Seta a action como padrão;
    private function defaultAction () {

        return $this->currentAction = DEFAULT_ACTION . ACTION_COMPLEMENT;

    }
    
    //Faz a chamada das classes correspondetes de controller e view.
    private function callControllerAndAction () {

        //Caso o Controller e a Action existam.
        if ($this->ClassAndMethodExistsAndParamsAreValid()) {

            $callController = new $this->currentController();

            if (!call_user_func_array (array($callController, $this->currentAction), $this->urlParameters)) {

                $this->notFoundPage();

            }

        } else {

            $this->notFoundPage();

        }

    }

    /**
     * Verifica se o controller e a action existem e se os parÂmetros adicionais condizem com a quantidade certa.
     * @return bool
     */
    private function ClassAndMethodExistsAndParamsAreValid () : bool {

        return method_exists($this->currentController, $this->currentAction) && $this->validateNumberOfParams();

    }

    /**
     * Função que valida se o numero de argumentos passados é igual ao da action em questão.
     * É uma função totalmente maleavel e se adapta a qualquer actopn.
     */
    private function validateNumberOfParams () : bool {

        $methodArguments = new ReflectionMethod ($this->currentController, $this->currentAction);
        $numberOfUrlParameters = count($this->urlParameters);

        //Caso o numero de parametros seja >= ao numero de parametros obrigatorios e <= ao numero de parametros no total
        return $numberOfUrlParameters >= $methodArguments->getNumberOfRequiredParameters()
               && 
               $numberOfUrlParameters <= $methodArguments->getNumberOfParameters();

    }


    /**
     * Chama uma página informando que o conteudo não foi encontrado.
     * 
     */
    private function notFoundPage () : bool {

        $controllerConstant = CONTROLLERS_ROUTE . 'PageNotFound\PageNotFound' . CONTROLLERS_COMPLEMENT;

        /** @noinspection PhpUndefinedMethodInspection */
        return (new $controllerConstant())->index();
    
    }

}
