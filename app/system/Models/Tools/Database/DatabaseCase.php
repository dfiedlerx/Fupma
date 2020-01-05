<?php namespace System\Models\Tools\Database;

use PDO;
use PDOStatement;

/**
 * Class DatabaseCase
 * @package System\Models\Tools\Database
 */
class DatabaseCase
{

    protected $databaseConnection;
    private $inTransation;

    /**
     * DatabaseCase constructor.
     * @param PDO $databaseConnection
     */
    public function __construct(PDO $databaseConnection) {

        $this->databaseConnection = $databaseConnection;
        $this->inTransation = false;

    }

    public function beginTransation () {

        if (!$this->inTransation) {

            $this->databaseConnection->beginTransaction();

        }

        $this->inTransation = true;

    }

    public function commit() {

        if ($this->inTransation) {

            $this->databaseConnection->commit();

        }

        $this->inTransation = false;

    }

    public function rollBack() {

        if ($this->inTransation) {

            $this->databaseConnection->rollBack();

        }

        $this->inTransation = false;

    }

    /**
     * @param string $prepareString
     * @param array $prepareOptions
     * @return PDOStatement
     */
    protected function prepare (string $prepareString, array $prepareOptions = []) : PDOStatement {

        return $this->databaseConnection->prepare($prepareString, $prepareOptions);

    }

    /**
     * @param string $sequence
     * @return string
     */
    public function getLastInsertId (string $sequence = '') : string {

        return
            empty($sequence)
                ? $this->databaseConnection->lastInsertId()
                : $this->databaseConnection->lastInsertId($sequence);

    }

}