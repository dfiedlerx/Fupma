<?php
/**
 * Created by PhpStorm.
 * User: Desenvolvimento
 * Date: 18/04/2018
 * Time: 14:16
 */

namespace Core\Tools\Database;


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
     * @return string
     */
    private static function iterableTerms (array $terms, string $innerImplode, string $outerImplode) : string {

        $processedTerms = [];

        foreach ($terms as $currentTerm) {


            $processedTerms[] = self::sequenceElements($currentTerm, $innerImplode);

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

        $selectQuery =
            'SELECT '
            . self::iterableTerms($tableTerms, ' AS ', ',')
            . ' FROM '
            . self::sequenceElements($fromTable, ' AS ')
            . self::joinTerms($joinTerms)
            . self::whereTerms($whereTerms)
            . self::orderByTerms($orderTerms)
            . self::limitTerms($limitTerms)
            ;

        return
            !$isSubQuery
                ? $selectQuery
                : '('.$selectQuery.')';

    }

    public static function makeDelete (string $tableName, array $whereTerms) : string {

        return
            'DELETE FROM '
            . $tableName
            . self::whereTerms($whereTerms);

    }

}