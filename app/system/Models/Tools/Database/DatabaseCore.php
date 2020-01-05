<?php namespace System\Models\Tools\Database;

use PDOStatement;

/**
 * Class DatabaseCore
 * @package System\Models\Tools\Database
 */
class DatabaseCore extends DatabaseCase
{

    /**
     * @param $arrayBinds
     * @param PDOStatement $PDOStatment
     */
    private function bindValue ($arrayBinds, PDOStatement $PDOStatment) {

        foreach ($arrayBinds as $currentBind) {

            $PDOStatment->bindValue($currentBind['0'], $currentBind['1']);

        }

    }

    /**
     * @param PDOStatement $PDOStatement
     * @return bool
     */
    private function execute (PDOStatement $PDOStatement) : bool {

        return $PDOStatement->execute();

    }

    /**
     * @param string $runQuery
     * @param array $bindParams
     * @return PDOStatement
     */
    public function run (string $runQuery, array $bindParams = []) : PDOStatement {

        $PDOStatement = $this->prepare($runQuery);
        $this->bindValue($bindParams, $PDOStatement);
        $this->execute($PDOStatement);

        return $PDOStatement;

    }

    /**
     * @param PDOStatement $PDOStatement
     * @return bool
     */
    public function hasResult (PDOStatement $PDOStatement) : bool {

        return self::amountOfResults($PDOStatement) > 0;

    }

    /**
     * @param PDOStatement $PDOStatement
     * @return int
     */
    public function amountOfResults (PDOStatement $PDOStatement) : int {

        return $PDOStatement->rowCount();

    }

}