<?php namespace Models\Tools\Basic;
/*
* Classe com o intuito de filtrar variaveis com conteúdos externos
*/

/**
 * Class Filter
 * @package Models\Tools\Basic
 * @author Daniel Fiedler
 */
class Filter {

    /**
     * Método que apenas filtra uma variavel interna
     * @param string $stringToFilter
     * @param int $typeOfFilter
     * @return mixed
     */
    public static function internalFilter(string $stringToFilter, int $typeOfFilter = FILTER_SANITIZE_STRING) {

        return filter_var($stringToFilter, $typeOfFilter);

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

        return filter_input($typeRequisition, $nameVar, $typeOfFilter);

    }
	
}
