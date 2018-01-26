<?php namespace Tools\ModelTools;
/*
* Classe com o intuito de filtrar variaveis com conteúdos externos
*/

/**
 * Class Filter
 * @package ModelTools
 */
class Filter {

    /**
     * Método que apenas filtra uma variavel interna
     * @param string $stringToFilter
     * @param int $typeOfFilter
     * @return mixed
     */
    public static function internalFilter (string $stringToFilter, int $typeOfFilter = FILTER_SANITIZE_STRING) {

        return filter_var ($stringToFilter, $typeOfFilter);

    }

    /**
     * Atributos necessários
     * Valor para $typeRequisition:
     * 1 - GET
     * 2 - POST
     * 3 - COOKIE
     * 4 - SERVER
     * 5 - ENV
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

		return filter_input(self::getTypeRequisition($typeRequisition), $nameVar, $typeOfFilter);

	}

    /**
     * Função privada que retorna qual o tipo de reuisição o sistema está enviando.
     * @param int $typeRequisition
     * @return int
     */
	private static function getTypeRequisition (int $typeRequisition) :int {

		if ($typeRequisition == 1){

			return INPUT_GET;

		} else if ($typeRequisition == 2){

			return INPUT_POST;

		} else if ($typeRequisition == 3){

			return INPUT_COOKIE;

		} else if ($typeRequisition == 4){

			return INPUT_SERVER;

		} else {

			return INPUT_ENV;

		}

	}

}
