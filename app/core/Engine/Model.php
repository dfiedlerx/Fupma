<?php namespace Core\Engine;
/* 
 * MAKROUP - ARQUITETURE PLATFORM
 * Classe que gerenciará as necessidades basicas do model.
 * 
 */

use System\Models\Tools\Database\DatabaseConnection;
use System\Models\Tools\Database\DatabaseCore;

/**
 * Class Model
 * @package Core\Engine
 * @author Daniel Fiedler
 */
class Model
{
    /**
     * @var DatabaseCore
     */
    public static $databaseConnection;

    public function __construct() {

        //Chama a classe para se conectar ao banco de dados.
        self::getDBConn();

    }

    public static function getDBConn () {

        if (!self::$databaseConnection) {

            self::$databaseConnection = new DatabaseConnection(DB_TYPE, DB_USER, DB_PASS, DB_HOST, DB_NAME, DB_ATTRIBUTES);
            self::$databaseConnection = self::$databaseConnection->getConnection();

        }

    }

}

