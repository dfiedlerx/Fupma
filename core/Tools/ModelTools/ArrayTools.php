<?php namespace Tools\ModelTools;
/**
 * Possui alguma das funções mais comuns que se pode precisar fazer
 * com arrays durante o funcionamento do sistema.
 *
 */

/**
 * Class ArrayTools
 * @package ModelTools
 * @author Daniel Fiedler
 */
class ArrayTools
{

    /**
     * Verifica se existem determinadas chaves em um json
     * @param array $suspect
     * @param array $keysToLook
     * @param bool $allowNullValues
     * @return bool
     */
    public static function isAExistsKeys (array $suspect, array $keysToLook, bool $allowNullValues = true) :bool {

        foreach ($keysToLook as $currentKey) {

            if (!array_key_exists ($currentKey, $suspect) || (!$allowNullValues && is_null ($suspect [$currentKey]))) {

                return false;

            }

        }

        return true;

    }

    /**
     * Conta a quantidade de elementos de um array. Opcionalmente ele pode ignorar valores nulos.
     *
     * @param array $array
     * @param bool $ignoreNullValues
     * @return int
     */
    public static function countArray (array $array, bool $ignoreNullValues = false) : int {

        if (!$ignoreNullValues) {

            return count($array);

        } else {

            $countTerms = 0;

            foreach ($array as $currentValue) {

                if (!is_null($currentValue)) {

                    $countTerms++;

                }

            }

            return $countTerms;

        }

    }

    /**
     * Verifica se um ou mais termos existem em um array
     * @param array $suspect
     * @param array $termToLook
     * @param bool $caseSensitive
     * @return bool
     */
    public static function arrayTermExists (array $suspect,  $termToLook, bool $caseSensitive = false) : bool {

        return in_array ($termToLook, $suspect, $caseSensitive);

    }

    /**
     * Reorganiza valores de um array
     * @param array $arrayToTrate
     * @return array
     */
    public static function organizeValuesWithNumbers (array $arrayToTrate) :array {

        return array_values ($arrayToTrate);

    }

}