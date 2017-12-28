<?php
/* 
 * MAKROUP - ARQUITETURE PLATFORM
 * Classe que gerenciará as necessidades basicas do model.
 * 
 */

class model
{
    
    //Cada uma Dessas variáveis fara uma ação diferente do banco de dados.
    protected static $DATABASE_INSERT;
    protected static $DATABASE_DELETE;
    protected static $DATABASE_SELECT;
    protected static $DATABASE_UPDATE;
    
    //Construtor que irá evocar as classes automaticamente.
    public function __construct () {

     	self::call_DATABASE_CRUD ();

    }

    private static function call_DATABASE_CRUD () {

    	if (!self::$DATABASE_INSERT && !self::$DATABASE_DELETE && !self::$DATABASE_SELECT && !self::$DATABASE_UPDATE) {

    		self::$DATABASE_INSERT = new DATABASE\DATABASE_INSERT ();
        	self::$DATABASE_DELETE = new DATABASE\DATABASE_DELETE ();
        	self::$DATABASE_SELECT = new DATABASE\DATABASE_SELECT ();
        	self::$DATABASE_UPDATE = new DATABASE\DATABASE_UPDATE ();

        }	

    }
}

