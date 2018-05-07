<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que determinará complementos de nomes de arquivos para o autoload.
 * 
 */

//Diretório dos Arquivos Front-End
define ('VIEWS_DIRECTORY', '../system/views/pages/');
define ('TEMPLATES_DIRECTORY', '../system/views/templates/');
define ('JS_DIRECTORY', 'js/');
define ('CSS_DIRECTORY', 'css/');


//Diretório dos Arquivos Back-End
define ('CONTROLLERS_ROUTE', 'System\\Controllers\\');
define ('MODELS_ROUTE', 'System\\Models\\');
define ('CORE_ROUTE', 'System\\Core\\');


//Complemento de Nome dos Arquivos
define ('CONTROLLERS_COMPLEMENT', 'Controller');
define ('MODELS_COMPLEMENT', '.Class');
define ('VIEWS_COMPLEMENT', 'View');
define ('TEMPLATES_COMPLEMENT', '.template');
define ('CORE_COMPLEMENT', '');
define ('ACTION_COMPLEMENT', '');

//Diretorio Raiz do sistema.
define ('SYSTEM_DIRECTORY', '');