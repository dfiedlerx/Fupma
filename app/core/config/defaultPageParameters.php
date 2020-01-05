<?php

/* 
 * Fupma - Mini Framework
 * Este arquivo determina quais serão os parametros padrões de Controller e Action.
 * 
 */

define
(
    'SERVER_LINK',
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') .'://'
    .$_SERVER['SERVER_NAME']
    .'/'
);

define ('DEFAULT_CONTROLLER', 'Home');
define('DEFAULT_ACTION', 'index');