<?php namespace Tools\ModelTools;

/* 
 * Classe encarregada de gerenciar a linguagem do sistema.
 * 
 */

use Engine;

/**
 * Class Language
 * @package ModelTools
 */
 class Language extends Engine\model{

     /**
      * Método que descobre a linguagem do usuário através do navegador.
      * @return mixed
      */
    public static function getBrowserLanguage(){

        return
            explode(',', Filter::externalFilter (4, 'HTTP_ACCEPT_LANGUAGE'), FILTER_SANITIZE_FULL_SPECIAL_CHARS)[0];

    } 

 }

