<?php namespace DATABASE;

/*
* Classe criada para se conectar ao banco de Dados.
* DB usado: Mysql
* Classe escolhida PDO. Pdo pois com ela é possível usar outros tipos de banco de dados no futuro.
* Esta classe nao possui comunicação com outras classes do sistema.
*/

use PDO;

/**
 * Class DATABASE_CONNECTION
 * @package DATABASE
 */
abstract class DATABASE_CONNECTION
{
	
    protected static $DB_CONNECTION;
    private static $DB_PARAMETERS;
    private static $DB_USER;
    private static $DB_PASS;

    /**
     * DATABASE_CONNECTION constructor.
     */
    public function __construct () {

        $this->PDOParameters ();
        $this->PDOCaller (); 

    }

    //Método Que pegára os dados do construtor e realizará a Conexão.
    private  function PDOCaller () {

        if(!self::$DB_CONNECTION){

             try{

                 self::$DB_CONNECTION =
                     new PDO (

                         self::$DB_PARAMETERS,
                         self::$DB_USER,
                         self::$DB_PASS

                     );

            } catch (PDOException $e) {

                echo
                    "Houve uma falha na conexão com o banco de dados: "
                    .$e->getMessage();

            } 

        }

    }

    //Método que setará os valores de acesso. Valores setados na config
    private function PDOParameters () {

        if (!self::$DB_PARAMETERS && !self::$DB_USER && !self::$DB_PASS) {

            self::$DB_PARAMETERS = DB_TYPE.":dbname=".DB_NAME.";host=".DB_HOST;
            self::$DB_USER = DB_USER;
            self::$DB_PASS = DB_PASS; 

        }

    }    

}
        
/* O único objetivo desta classe é conectar ao banco. As demais ações serão obrigatoriamente subjulgadas à outras classes. Esta a "Great Mother" das classes DATABASE */