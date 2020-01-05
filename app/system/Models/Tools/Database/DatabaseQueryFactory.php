<?php namespace System\Models\Tools\Database;

/**
 * Class DatabaseQueryFactory
 * @package System\Models\Tools\Database
 */
class DatabaseQueryFactory
{

    /**
     * @param array $elements
     * @param string $implodeTerm
     * @return string
     */
    private static function sequenceElements (array $elements, string $implodeTerm = ',') : string {

        return implode($implodeTerm, $elements);

    }

    /**
     * @param array $terms
     * @param string $innerImplode
     * @param string $outerImplode
     * @param bool $insertSubQuery
     * @return string
     */
    private static function iterableTerms (array $terms, string $innerImplode, string $outerImplode, bool $insertSubQuery = false) : string {

        $processedTerms = [];

        foreach ($terms as $currentTerm) {


            $processedTerms[] = self::returnQuery(self::sequenceElements($currentTerm, $innerImplode), $insertSubQuery);

        }

        return self::sequenceElements($processedTerms, $outerImplode);

    }

    /**
     * @param array $joinTerms
     * @return string
     */
    private static function joinTerms (array $joinTerms) : string {

        if ($joinTerms == []) {

            return '';

        }

        $formatedString = '';

        foreach ($joinTerms as $currentJoinTerm) {

            $formatedString .=
                ' '
                . $currentJoinTerm['0']
                . ' JOIN '
                . self::sequenceElements($currentJoinTerm['1'], ' AS ')
                . ' ON (' .self::iterableTerms($currentJoinTerm['2'], ' ', ' ') . ') ';

        }

        return $formatedString;

    }

    /**
     * @param array $orderTerms
     * @return string
     */
    private static function orderByTerms (array $orderTerms) : string {

        if ($orderTerms == []) {

            return '';

        }

        return
            ' ORDER BY '
            . self::iterableTerms($orderTerms, ' ', ',')
            .' ';

    }

    /**
     * @param array $whereTerms
     * @return string
     */
    private static function whereTerms (array $whereTerms) : string {

        if ($whereTerms == []) {

            return '';

        }

        return
            ' WHERE '
            . self::iterableTerms($whereTerms, ' ', ' ');

    }

    /**
     * @param array $limitTerms
     * @return string
     */
    private static function limitTerms (array $limitTerms) : string {

        if ($limitTerms == []) {

            return '';

        }

        return
            ' LIMIT '
            . self::sequenceElements($limitTerms, ',').' ';

    }

    /**
     * @param $query
     * @param bool $isSubQuery
     * @return string
     */
    private static function returnQuery ($query, $isSubQuery = false) : string {

        return
            !$isSubQuery
                ? $query
                : ' ('.$query.') ';

    }

    /**
     * @param array $tableTerms
     * @param array $fromTable
     * @param array $joinTerms
     * @param array $whereTerms
     * @param array $orderTerms
     * @param array $limitTerms
     * @param bool $isSubQuery
     * @return string
     */
    public static function makeSelect (
        array $tableTerms, array $fromTable, array $joinTerms = [],
        array $whereTerms = [], array $orderTerms = [], array $limitTerms = [],
        bool $isSubQuery = false
    ) : string {

        return
            self::returnQuery
            (
                ' SELECT '
                . self::iterableTerms($tableTerms, ' AS ', ',')
                . ' FROM '
                . self::iterableTerms($fromTable, ' AS ', ',')
                . self::joinTerms($joinTerms)
                . self::whereTerms($whereTerms)
                . self::orderByTerms($orderTerms)
                . self::limitTerms($limitTerms)
                , $isSubQuery
            );

    }

    /**
     * @param array $tableName
     * @param array $whereTerms
     * @param array $joinTerms
     * @param bool $isSubQuery
     * @return string
     */
    public static function makeDelete (array $tableName, array $whereTerms, array $joinTerms = [], bool $isSubQuery = false) : string {

        return
            self::returnQuery (
                ' DELETE '
                . $tableName['0']
                . ' FROM '
                . self::sequenceElements($tableName, ' AS ')
                . self::joinTerms($joinTerms)
                . self::whereTerms($whereTerms)
                , $isSubQuery
            );

    }

    /**
     * @param string $tableName
     * @param array $valueTerms
     * @param array $whereTerms
     * @param array $joinTerms
     * @param bool $isSubQuery
     * @return string
     */
    public static function makeUpdate (string $tableName, array $valueTerms, array $whereTerms, array $joinTerms = [], bool $isSubQuery = false) : string {

        return
            self::returnQuery
            (
                ' UPDATE '
                . $tableName
                . self::joinTerms($joinTerms)
                . ' SET '
                . self::iterableTerms($valueTerms, '=', ',')
                . self::whereTerms($whereTerms)
                , $isSubQuery
            );

    }

    /**
     * @param string $tableName
     * @param array $tableColumns
     * @param array $insertValues
     * @param bool $isSubQuery
     * @return string
     */
    public static function makeInsert (string $tableName, array $tableColumns, array $insertValues, bool $isSubQuery = false) : string {

        return
            self::returnQuery
            (
                ' INSERT INTO '
                . $tableName
                . self::returnQuery(self::sequenceElements($tableColumns), true)
                . ' VALUES '
                . self::iterableTerms($insertValues, ',', ',', true)
                , $isSubQuery
            );

    }

}