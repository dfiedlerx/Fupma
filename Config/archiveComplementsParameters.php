<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que determinará complementos de nomes de arquivos para o autoload.
 * 
 */

//Diretório dos Arquivos Front-End
define ('VIEWS_DIRECTORY', 'Views/pages/');
define ('TEMPLATES_DIRECTORY', 'Views/templates/');
define ('JS_DIRECTORY', 'Views/assets/js/');
define ('CSS_DIRECTORY', 'Views/assets/css/');


//Diretório dos Arquivos Back-End
define ('CONTROLLERS_DIRECTORY', 'Controllers\\');
define ('MODELS_DIRECTORY', 'Models\\');
define ('CORE_DIRECTORY', 'Core\\');


//Complemento de Nome dos Arquivos
define ('CONTROLLERS_COMPLEMENT', 'Controller');
define ('MODELS_COMPLEMENT', '.Class');
define ('VIEWS_COMPLEMENT', 'View');
define ('TEMPLATES_COMPLEMENT', '.template');
define ('CORE_COMPLEMENT', '');
define ('ACTION_COMPLEMENT', '');

//Diretorio Raiz do sistema.
define ('SYSTEM_DIRECTORY', '/mvc/');