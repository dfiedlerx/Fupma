<?php

/* 
 * Fupma - Mini Framework
 * Arquivo que determina os detalhes de conexão ao banco de dados.
 * 
 */

//Caso seja ambiente de desenvolvimento
if (ENVIRONMENT){

    //Tipo do Banco de dados.
    define ('DB_TYPE', 'mysql');
    //Nome da Base de dados.
    define ('DB_NAME', 'rede');
    //URL de acesso ao host da Base de Dados.
    define ('DB_HOST', 'localhost');
    //Usuário de acesso a Base de Dados.
    define ('DB_USER', 'root');
    //Senha de acesso a Base de Dados.
    define ('DB_PASS', '');

}
//Caso seja ambiene de produção.
else{

    define ('DB_TYPE', 'mysql');
    //Nome da Base de dados.
    define ('DB_NAME', 'rede');
    //URL de acesso ao host da Base de Dados.
    define ('DB_HOST', 'localhost');
    //Usuário de acesso a Base de Dados.
    define ('DB_USER', 'root');
    //Senha de acesso a Base de Dados.
    define ('DB_PASS', '');

}
    
 
define ('DB_ATTRIBUTES',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);


