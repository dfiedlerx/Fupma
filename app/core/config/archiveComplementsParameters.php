<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que determinará complementos de nomes de arquivos para o autoload.
 * 
 */

//Diretorio raiz do servidor
define ('PRIMAL_DIR', dirname(__FILE__) . '/../../');

//Diretorio Raiz do sistema MVC
define ('SYSTEM_DIRECTORY', PRIMAL_DIR . 'system/');

//Diretório dos Arquivos Front-End
define ('VIEWS_DIRECTORY', SYSTEM_DIRECTORY . 'Views/');
define ('JS_DIRECTORY', '');
define ('CSS_DIRECTORY', '');


//Diretório dos Arquivos Back-End
define ('CONTROLLERS_ROUTE', 'System\\Controllers\\');
define ('MODELS_ROUTE', 'System\\Models\\');
define ('CORE_ROUTE', 'Core\\');


//Complemento de Nome dos Arquivos
define ('CONTROLLERS_COMPLEMENT', 'Controller');
define ('MODELS_COMPLEMENT', '.Class');
define ('VIEWS_COMPLEMENT', 'View');
define ('TEMPLATES_COMPLEMENT', '.template');
define ('CORE_COMPLEMENT', '');
define ('ACTION_COMPLEMENT', '');
