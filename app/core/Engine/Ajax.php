<?php namespace Core\Engine;


use System\Controllers\Dashboard\DashboardController;
use System\Models\Tools\Basic\GlobalValue;

class Ajax extends Controller
{

    /**
     * Chama a view de acesso negado caso não seja uma requisição ajax
     * @param bool $negateThis
     */
    protected function blockNoAjaxCalls (bool $negateThis = false) {

        if (!$this->isAjaxCall() || $negateThis) {

            //Chama o construtor da classe Dashboard Controller para iniciar a classe dashboard Assets
            (new DashboardController());

            //Chama a view de demonstração de erros e finaliza o script
            GlobalValue::set('Acesso Negado!', 'viewData->errorMessage');
            GlobalValue::set('Acesso Negado', 'viewData->errorTitle');
            $this->loadView('pages/error/errorMessage');
            exit;

        }

    }

    /**
     * Verificação básica que retorna true caso seja uma requisição ajax
     * @return bool
     */
    protected function isAjaxCall () : bool {

        return
            isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

    }

}