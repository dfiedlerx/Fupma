<?php namespace System\Models\Tools\Database;

use PDO;

/**
 * Class DatabaseConnection
 * @package System\Models\Tools\Database
 */
class DatabaseConnection
{
    private $DBType;
    private $DBUser;
    private $DBPass;
    private $DBName;
    private $DBHost;
    private $DBAttributes;

    /**
     * DatabaseConnection constructor.
     * @param string $DBType
     * @param string $DBUser
     * @param string $DBPass
     * @param string $DBHost
     * @param string $DBName
     * @param array $DBAttributes
     */
    public function __construct
    (
        string $DBType,
        string $DBUser,
        string $DBPass,
        string $DBHost,
        string $DBName = '',
        array $DBAttributes = []
    ) {

        $this->DBType = $DBType;
        $this->DBUser = $DBUser;
        $this->DBPass = $DBPass;
        $this->DBName = $DBName;
        $this->DBHost = $DBHost;
        $this->DBAttributes = $DBAttributes;

    }

    /**
     * @return DatabaseCore
     */
    public function getConnection () : DatabaseCore {

        return new DatabaseCore (

            new PDO
            (
                $this->getConnectionString()
                , $this->DBUser
                , $this->DBPass
                , $this->DBAttributes
            )

        );

    }

    /**
     * @return string
     */
    private function getConnectionString () {

        return
            $this->DBType.':'
            . ($this->DBName != '' ? 'dbname='.$this->DBName.';' : '')
            .'host='.$this->DBHost;

    }

}