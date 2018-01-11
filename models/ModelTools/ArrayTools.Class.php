<?php namespace ModelTools;
/**
 * Possui alguma das funções mais comuns que se pode precisar fazer
 * com arrays durante o funcionamento do sistema.
 *
 */

/**
 * Class ArrayTools
 * @package ModelTools
 */
class ArrayTools
{

    /**
     * Verifica se existem determinadas chaves em um json
     *
     * @param array $suspect
     * @param array $termsToLook
     * @return bool
     */
    public static function isAExistsKeys (array $suspect, array $keysToLook) :bool {

        foreach ($keysToLook as $currentKey) {

            if (!array_key_exists ($currentKey, $suspect)) {

                return false;

            }

        }

        return true;

    }

    /**
     * Verifica se determinado termo existe no array e não e nulo
     * @param array $suspect
     * @param array $termsToLook
     * @return bool
     */
    public static function isAExistsKeysAndNotNull (array $suspect, array $keysToLook) :bool {

        foreach ($keysToLook as $currentKey) {

            if (!isset ($currentKey, $suspect)) {

                return false;

            }

        }

        return true;

    }

    /**
     * Conta a quantidade de elementos de um array
     * @param array $array
     * @return int
     */
    public static function countArray (array $array) : int {

        return count ($array);

    }

    /**
     * Verifica se um ou mais termos existem em um array
     * @param array $suspect
     * @param array $termsToLook
     * @param bool $caseSensitive
     * @return bool
     */
    public static function isAExistsTerm (array $suspect, array $termsToLook, bool $caseSensitive = false) : bool {

        return in_array ($termsToLook, $suspect, $caseSensitive);

    }

    /**
     * Reorganiza valores de um array
     * @param array $arrayToTrate
     * @return array
     */
    public static function organizeValuesWithNumbers (array $arrayToTrate) {

        return array_values ($arrayToTrate);

    }

}