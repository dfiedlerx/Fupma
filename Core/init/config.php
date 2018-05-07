<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que carrega as contantes do servidor, Será uilizado aqui coisas que
 * em determinado momento poderão ser mudadas ou alteradas com alta probabilidade.
 * 
 */

$dirnameConfig = dirname(__FILE__).'/../config/';

// Arquivos de Configuração Mestre.
require $dirnameConfig.'environment.php';
require $dirnameConfig.'archiveComplementsParameters.php';
require $dirnameConfig.'defaultPageParameters.php';
require $dirnameConfig.'tableSequencesParameters.php';
require $dirnameConfig.'dependences.php';
require $dirnameConfig.'systemParameters.php';

//Arquivos de Configuração Complementares.    
require $dirnameConfig.'DBConnectionParameters.php';

//Remove a variavel apos o uso
unset($dirnameConfig);

