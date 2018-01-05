<?php
/**
 * Created by PhpStorm.
 * User: Developer5
 * Date: 04/01/2018
 * Time: 16:02
 */

namespace ModelTools;

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
    public static function isAExistsKeys (array $suspect, array $termsToLook):bool {

        foreach ($termsToLook as $currentTerm) {

            if (!isset ($suspect[$currentTerm])) {

                return false;

            }

        }

        return true;

    }

}