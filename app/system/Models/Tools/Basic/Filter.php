<?php namespace System\Models\Tools\Basic;


/**
 * Classe com o intuito de filtrar variaveis com conteúdos externos
 *
 * Class Filter
 * @package System\Models\Tools\Basic
 * @author Daniel Fiedler
 */
class Filter {

    /**
     * Método que apenas filtra uma variavel interna
     *
     * @param string $valueToFilter
     * @param int $typeOfFilter
     * @return mixed
     */
    public static function internalFilter (string $valueToFilter, int $typeOfFilter = FILTER_SANITIZE_STRING) {

        return filter_var ($valueToFilter, $typeOfFilter);

    }

    /**
     * Filtra diversos valores de um array de uma vez
     *
     * @param array $valueToFilter
     * @param $listOfFilters
     * @return mixed
     */
    public static function internalArrayFilter (array $valueToFilter, $listOfFilters) {

        return filter_var_array($valueToFilter, $listOfFilters);

    }

    /**
     * Filtra e obtém um valor global externo como $_POST
     *
     * @param int $typeRequisition
     * @param string $nameVar
     * @param int $typeOfFilter
     * @return mixed
     */
	public static function externalFilter (
	    int $typeRequisition,
        string $nameVar,
        int $typeOfFilter = FILTER_SANITIZE_SPECIAL_CHARS
    ){

		return filter_input($typeRequisition, $nameVar, $typeOfFilter);

	}

    /**
     * Filtra mais que um valor de uma vez
     *
     * @param int $typeRequisition
     * @param array $keysArray
     * @return mixed
     */
	public static function externalArrayFilter (int $typeRequisition, array $keysArray) {

	    return filter_input_array($typeRequisition, $keysArray);

    }

    /**
     * Verifica se determinado valor global existe
     *
     * @param int $typeRequisition
     * @param array $valuesKeys
     * @param bool $allowNullValues
     * @return bool
     */
	public static function externalValuesExists (int $typeRequisition, array $valuesKeys, bool $allowNullValues = true) : bool {

	    foreach ($valuesKeys as $currentKey) {

            if (
                (
                    $allowNullValues
                    &&
                    ($typeRequisition == INPUT_POST && !isset($_POST[$currentKey]))
                    ||
                    ($typeRequisition == INPUT_GET && !isset($_GET[$currentKey]))
                    ||
                    ($typeRequisition == INPUT_COOKIE && !Cookie::searchCookie($currentKey))
                    ||
                    ($typeRequisition == INPUT_SERVER && !isset($_SERVER[$currentKey]))
                )
                ||
                (
                    !$allowNullValues && !filter_input($typeRequisition, $currentKey)
                )
            ) {

                return false;

            }

        }

        return true;

    }
	
}
