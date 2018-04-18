<?php

/* 
 * 
 * Arquivo que terá o autoload para procurar pelas classes do sistema.
 * 
 */

spl_autoload_register(function ($className) {

    $className = str_replace('\\', '/', $className);
    $baseDirectory = dirname(__FILE__).'/../../';

    if (file_exists($baseDirectory . $className . MODELS_COMPLEMENT . '.php')) {

        require_once $baseDirectory . $className . MODELS_COMPLEMENT . '.php';

    }

    if (file_exists($baseDirectory . $className . CORE_COMPLEMENT . '.php')) {

        require_once  $baseDirectory . $className . CORE_COMPLEMENT . '.php';

    }

    if (file_exists($baseDirectory . $className . '.php')) {

        require_once ($baseDirectory . $className . '.php');

    }

});
