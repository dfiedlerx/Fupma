<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

//Arquivo que carregará as configurações
require  'Core/init/config.php';

// Auto Loader que chamara as classes do sistema.
require dirname(__FILE__) . '/vendor/autoload.php';

//Inicia a engrenagem da arquitetura
(new Core\Engine\Core())->run();
