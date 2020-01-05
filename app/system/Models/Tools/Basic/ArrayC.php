<?php namespace System\Models\Tools\Basic;
/**
 * Possui alguma das funções mais comuns que se pode precisar fazer
 * com arrays durante o funcionamento do sistema.
 *
 */

/**
 * Class ArrayTools
 * @package System\Models\Tools\Basic
 * @author Daniel Fiedler
 */
class ArrayC
{

    /**
     * Verifica se existem determinadas chaves em um json.
     *
     * @param array $suspect
     * @param array $keysToLook
     * @param bool $allowNullValues
     * @return bool
     */
    public static function isAExistsKeys (array $suspect, array $keysToLook, bool $allowNullValues = true) :bool {

        foreach ($keysToLook as $currentKey) {

            if (!array_key_exists ($currentKey, $suspect) || (!$allowNullValues && is_null($suspect [$currentKey]))) {

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

        return
            !$ignoreNullValues
                ? count($array)
                : self::countNotNullValues($array);

    }

    /**
     * Retorna o numero de valores principais de um array que não possuam valor nulo.
     *
     * @param array $array
     * @return int
     */
    private static function countNotNullValues (array $array) : int {

        $countTerms = 0;

        foreach ($array as $currentValue) {

            if (!is_null($currentValue)) {

                $countTerms++;

            }

        }

        return $countTerms;

    }

    /**
     * Verifica se um ou mais termos existem em um array.
     *
     * @param array $suspect
     * @param array $termToLook
     * @param bool $restrictType
     * @return bool
     */
    public static function arrayTermExists (array $suspect, $termToLook, bool $restrictType = false) : bool {

        return in_array ($termToLook, $suspect, $restrictType);

    }

    /**
     * Reorganiza valores de um array.
     *
     * @param array $arrayToTrate
     * @return array
     */
    public static function organizeValuesWithNumbers (array $arrayToTrate) :array {

        return array_values ($arrayToTrate);

    }

    /**
     * Retorna true caso um array não esteja vazio
     *
     * @param array $array
     * @return bool
     */
    public static function noEmptyArray (array $array) : bool {

        return count($array) > 0;

    }

}