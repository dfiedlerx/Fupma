<?php /** @noinspection PhpUnhandledExceptionInspection */


namespace Core\Engine;


use ReflectionException;
use System\Models\Tools\Basic\Filter;
use ReflectionMethod;
use System\Models\Tools\Basic\StringC;


/**
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
 * Class Core
 * @package Core\Engine
 * @author Daniel Fiedler
 */
class Core
{

    private static $currentController;
    private static $currentAction;
    private static $urlParameters;
    private static $methodParams = [];
    private static $controllerExistsAndIsUsable = false;
    private static $methodExists = false;

    /**
     * Gerenciador do Core
     */
    public static function run () {

        Model::getDBConn();
        self::trateUrl();
        self::makeParametersArray();
        self::setControllerAndAction();
        self::callControllerAndAction();

    }

    /**
     * Remove domínio da url e remove parametros GET
     */
    private static function trateUrl () {

        self::$urlParameters = str_replace
        (

            SYSTEM_DIRECTORY,
            '',
            Filter::internalFilter($_SERVER ['REQUEST_URI'], FILTER_SANITIZE_URL)

        );

        self::$urlParameters =
            StringC::removeAllAfterTerm('?', self::$urlParameters);

    }

    /**
     * Método que irá destrinchar a urlParameters e obtera o Controller e a action em um array.
     */
    private static function makeParametersArray () {

        self::$urlParameters = explode('/', self::$urlParameters);

        //Caso o link padrão seja o diretório raiz do sistema
        if (self::paramExistsAndIsEmpty(0)) {

            self::removeFirstParameter();

        }

        //Converte para maiscula todas as primeiras letras de cada parâmetro
        foreach (self::$urlParameters as $paramKey => $currentParam) {

            self::$urlParameters[$paramKey] = ucfirst($currentParam);

        }

    }

    /**
     * Método que irá atribuir os valores corretos para $currentController e
     * $currentAction;
     *
     */
    private static function setControllerAndAction () {

        $countParams = count(self::$urlParameters);

        if ($countParams > 0 && !empty (self::$urlParameters[0])) {

            self::tryToFindControllerAndAction($countParams);

        } else {

            self::defaultController();
            self::$controllerExistsAndIsUsable = true;
            self::defaultAction();

        }

    }

    private static function tryToFindControllerAndAction (int $countParams) {

        $itCount = 1;
        $possibleAction = '';

        while ($itCount <= $countParams) {

            $possibleClassName = self::$urlParameters[$countParams - $itCount];
            $controllerNamespace = self::getNamespaceController() . '\\' . $possibleClassName . CONTROLLERS_COMPLEMENT;
            self::$methodExists = method_exists($controllerNamespace, $possibleAction);

            if(self::$methodExists) {

                array_pop(self::$methodParams);

            }

            /** @noinspection PhpMethodParametersCountMismatchInspection */
            if
            (
                $itCount > 1
                &&
                self::ClassAndMethodExistsAndParamsAreValid($controllerNamespace, $possibleAction)
            ) {

                self::$currentController = $controllerNamespace;
                self::$currentAction = $possibleAction;
                self::$controllerExistsAndIsUsable = true;
                self::$methodParams = array_reverse(self::$methodParams);

            } else if (self::$methodExists) {

                self::$controllerExistsAndIsUsable = false;

            } else if (self::ClassAndMethodExistsAndParamsAreValid($controllerNamespace, DEFAULT_ACTION)) {

                self::$currentController = $controllerNamespace;
                self::defaultAction();
                self::$controllerExistsAndIsUsable = true;
                break;

            }  else {

                self::$methodParams[] = strtolower($possibleClassName);
                $possibleAction = strtolower($possibleClassName);
                self::removeLastParameter();
                self::$controllerExistsAndIsUsable = false;

            }

            $itCount += 1;

        }

    }

    private static function getNamespaceController () : string {

        return CONTROLLERS_ROUTE . implode('\\', self::$urlParameters);

    }

    /**
     * Remove o primeiro parametro do array.
     * @return mixed
     */
    private static function removeFirstParameter () {

        return array_shift(self::$urlParameters);

    }

    /**
     * Remove o ultimo parâmetro do array
     * @return mixed
     */
    private static function removeLastParameter () {

        return array_pop(self::$urlParameters);

    }

    /**
     * Verifica se o elemento no indice passado existe e não é nulo ou uma string vazia
     * @param int $paramIndex
     * @return bool
     */
    private static function paramExistsAndIsEmpty (int $paramIndex) : bool {

        return
            isset (self::$urlParameters[$paramIndex]) &&
            (self::$urlParameters[$paramIndex] == '' || is_null(self::$urlParameters[$paramIndex]));

    }

    //Seta o Controller Padrão
    private static function defaultController () {

        self::$currentController =
            CONTROLLERS_ROUTE . DEFAULT_CONTROLLER . '\\' .DEFAULT_CONTROLLER . CONTROLLERS_COMPLEMENT;

    }

    //Seta a action como padrão;
    private static function defaultAction () {

        return self::$currentAction = DEFAULT_ACTION . ACTION_COMPLEMENT;

    }

    /**
     * Faz a chamada das classes correspondetes de controller e view.
     *
     */
    private static function callControllerAndAction () {

        //Caso o Controller e a Action existam.
        if (self::$controllerExistsAndIsUsable) {

            $callController = new self::$currentController();

            //Traduz termos da url para termos comuns
            self::$methodParams = StringC::urlDecodeArray(self::$methodParams);

            if (!call_user_func_array (array($callController, self::$currentAction), self::$methodParams)) {

                self::notFoundPage();

            }

        } else {

            self::notFoundPage();

        }

    }

    /**
     * Verifica se o controller e a action existem e se os parâmetros adicionais condizem com a quantidade certa.
     * @param string $className
     * @param string $methodName
     * @return bool
     * @throws ReflectionException
     */
    private static function ClassAndMethodExistsAndParamsAreValid (string $className, string $methodName) : bool {

        if ($methodName == DEFAULT_ACTION) {

            self::$methodExists = method_exists($className, $methodName);

        }

        return self::$methodExists && self::validateNumberOfParamsAndPublicMethod($className, $methodName);

    }

    /**
     * Função que valida se o numero de argumentos passados é igual ao da action em questão.
     * É uma função totalmente maleavel e se adapta a qualquer action.
     *
     * @param string $className
     * @param string $methodName
     * @return bool
     * @throws ReflectionException
     */
    private static function validateNumberOfParamsAndPublicMethod (string $className, string $methodName) : bool {

        $targetCallable = new ReflectionMethod ($className, $methodName);
        $numberOfUrlParameters = count(self::$methodParams);

        //Caso o numero de parametros seja >= ao numero de parametros obrigatorios e <= ao numero de parametros no total
        return $numberOfUrlParameters >= $targetCallable->getNumberOfRequiredParameters()
               && 
               $numberOfUrlParameters <= $targetCallable->getNumberOfParameters()
               && $targetCallable->isPublic();

    }


    /**
     * Chama uma página informando que o conteudo não foi encontrado.
     * 
     */
    private static function notFoundPage () : bool {

        $controllerConstant = CONTROLLERS_ROUTE . 'PageNotFound\PageNotFound' . CONTROLLERS_COMPLEMENT;

        /** @noinspection PhpUndefinedMethodInspection */
        return (new $controllerConstant())->index();
    
    }

}
