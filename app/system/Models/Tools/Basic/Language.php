<?php namespace System\Models\Tools\Basic;

/* 
 * Classe encarregada de gerenciar a linguagem do sistema.
 * 
 */

/**
 * Class Language
 * @package System\Models\Tools\Basic
 * @author Daniel Fiedler
 */
 class Language
 {

     /**
      * Método que descobre a linguagem do usuário através do navegador.
      *
      * @return mixed
      */
    public static function getBrowserLanguage(){

        return
            explode(',', Filter::externalFilter (4, 'HTTP_ACCEPT_LANGUAGE'), FILTER_SANITIZE_FULL_SPECIAL_CHARS)[0];

    } 

 }

