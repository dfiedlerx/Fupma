<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que carrega as contantes do servidor, Será uilizado aqui coisas que
 * em determinado momento poderão ser mudadas ou alteradas com alta probabilidade.
 * 
 */

// Arquivos de Configuração Mestre.

    require 'Config/environment.php';
    require 'Config/archiveComplementsParameters.php';
    require 'Config/defaultPageParameters.php';
    require 'Config/tableSequencesParameters.php';
    require 'Config/dependences.php';
    require 'Config/cookieParameters.php';

//Arquivos de Configuração Complementares.    
    require 'Config/DBConnectionParameters.php';

