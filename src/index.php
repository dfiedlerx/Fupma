<?php
//Arquivo que carregará as configurações
require 'config/config.php';

// Auto Loader que chamara as classes do sistema.
require CORE_DIRECTORY."autoload.php";

$core = (new core())->run ();
