<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que determina os detalhes de conexão ao banco de dados.
 * 
 */

//Caso seja ambiente de desenvolvimento
if (ENVIRONMENT){

    //Tipo do Banco de dados.
    define ('DB_TYPE', 'pgsql');
    //Nome da Base de dados.
    define ('DB_NAME', 'projectRepDBPlatform');
    //URL de acesso ao host da Base de Dados.
    define ('DB_HOST', 'localhost');
    //Usuário de acesso a Base de Dados.
    define ('DB_USER', 'postgres');
    //Senha de acesso a Base de Dados.
    define ('DB_PASS', 'admin');

}
//Caso seja ambiene de produção.
else{

     define ('DB_TYPE', '?');
    //Nome da Base de dados.
    define ('DB_NAME', '?');
    //URL de acesso ao host da Base de Dados.
    define ('DB_HOST', '?');
    //Usuário de acesso a Base de Dados.
    define ('DB_USER', '?');
    //Senha de acesso a Base de Dados.
    define ('DB_PASS', '?');

}
    
 



