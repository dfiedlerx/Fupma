<?php namespace Core\Engine;


/**
 * Classe que gerenciará as necessidades basicas do model.
 * Class Controller
 * @package Core\Engine
 * @author Daniel Fiedler
 */
class Controller
{

    protected $view;

    public function __construct() {



    }

    /**
     * Chama página de visão para o sistema.
     * @param string $pathOfView
     * @return bool
     */
    protected function loadView (string $pathOfView) {

        $pathOfView = VIEWS_DIRECTORY . $pathOfView . VIEWS_COMPLEMENT . '.php';

        if (file_exists($pathOfView)) {

            include $pathOfView;
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

    /**
     * Verifica se a sess]ao ja foi iniciada e caso ainda não tenha sido, inicia imediatamente
     */
    protected function getSession () {

        if ($this->sessionExists()) {

            session_start();

        }

    }

    /**
     * Verifica se a sessão ja foi iniciada no sistema
     * @return bool
     */
    protected function sessionExists () : bool {

        return session_status() === PHP_SESSION_ACTIVE;

    }

    protected function redirect ($location, $header = true) {

        if ($header) {

            header('Location: '. $location);

        } else {

            echo '<script>window.location = "'.$location.'"</script>';

        }

    }

}
