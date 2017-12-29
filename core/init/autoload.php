<?php

/* 
 * 
 * Arquivo que terá o autoload para procurar pelas classes do sistema.
 * 
 */

spl_autoload_register(function ($className) {

    $className = str_replace('\\', '/', $className);

    if (file_exists(MODELS_DIRECTORY . $className . MODELS_COMPLEMENT . '.php')) {

        require MODELS_DIRECTORY . $className . MODELS_COMPLEMENT . '.php';

    }

    if (file_exists(CORE_DIRECTORY . $className . CORE_COMPLEMENT . '.php')) {

        require CORE_DIRECTORY . $className . CORE_COMPLEMENT . '.php';

    }

    if (file_exists(CONTROLLERS_DIRECTORY . $className . '.php')) {

        require (CONTROLLERS_DIRECTORY . $className . '.php');

    }

});
