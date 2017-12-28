<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que determinará complementos de nomes de arquivos para o autoload.
 * 
 */

//Diretório dos Arquivos Front-End
define ('VIEWS_DIRECTORY', 'views/');

define ('JS_DIRECTORY', 'views/assets/js/');
define ('CSS_DIRECTORY', 'views/assets/css/');


//Diretório dos Arquivos Back-End
define ('CONTROLLERS_DIRECTORY', 'controllers/');
define ('MODELS_DIRECTORY', 'models/');
define ('CORE_DIRECTORY', 'core/');


//Complemento de Nome dos Arquivos

define ('CONTROLLERS_COMPLEMENT', 'Controller');
define ('MODELS_COMPLEMENT', '.Class');
define ('VIEWS_COMPLEMENT', 'View');
define ('CORE_COMPLEMENT', '');
define ('ACTION_COMPLEMENT', '');

//Diretorio Raiz do sistema. Deve incluir /index.php e sem barra no final
define ('SYSTEM_DIRECTORY', '/mvc/index.php');