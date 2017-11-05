<?php

/* 
 * 
 * Arquivo que terá o autoload para procurar pelas classes do sistema.
 * 
 */

spl_autoload_register(function ($className) {
	
    if (strpos($className, CONTROLLERS_COMPLEMENT)) {

        if (file_exists(CONTROLLERS_DIRECTORY . $className . '.php')) {
            
            require (CONTROLLERS_DIRECTORY . $className . '.php');

        }
        
    } 

    else if (file_exists(MODELS_DIRECTORY . $className . MODELS_COMPLEMENT . '.php')) {
        
        require MODELS_DIRECTORY . $className . MODELS_COMPLEMENT . '.php';

    } 

    else if (file_exists(CORE_DIRECTORY . $className.CORE_COMPLEMENT . '.php')) {
        
        require CORE_DIRECTORY.$className.CORE_COMPLEMENT.'.php';
        
    }
});
