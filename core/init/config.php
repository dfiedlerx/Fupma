<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que carrega as contantes do servidor, Será uilizado aqui coisas que
 * em determinado momento poderão ser mudadas ou alteradas com alta probabilidade.
 * 
 */

// Arquivos de Configuração Mestre.

    require 'config/environment.php';
    require 'config/archiveComplementsParameters.php';
    require 'config/defaultPageParameters.php';
    require 'config/tableSequencesParameters.php';
    require 'config/dependences.php';
    require 'config/cookieParameters.php';

//Arquivos de Configuração Complementares.    
    require 'config/DBConnectionParameters.php';

