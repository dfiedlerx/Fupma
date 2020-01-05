<?php

use Core\Engine\Core;

// Auto Loader que chamara as classes do sistema.
require dirname(__FILE__) . '/../app/vendor/autoload.php';

//Arquivo que carregará as configurações
require  dirname(__FILE__) . '/../app/core/init/config.php';

//Inicia a engrenagem da arquitetura
Core::run();
