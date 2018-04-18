<?php namespace Core\Tools\Database;

use PDOStatement;

/**
 * Class DatabaseCore
 * @package Core\Tools\Database
 */
class DatabaseCore extends DatabaseCase
{

    /**
     * @param $arrayBinds
     * @param PDOStatement $PDOStatment
     */
    private function bindValue ($arrayBinds, PDOStatement $PDOStatment) {

        foreach ($arrayBinds as $currentBind) {

            $PDOStatment->bindValue(':'.$currentBind['0'], $currentBind['1']);

        }

    }

    /**
     * @param PDOStatement $PDOStatement
     * @return bool
     */
    private function execute (PDOStatement $PDOStatement) : bool {

        return $PDOStatement->execute();

    }

}