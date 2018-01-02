<?php namespace ModelTools;
/*
* Classe com o intuito de filtrar variaveis com conteúdos externos
*/

class ExternalFilter {

	/*

	Função publica que retorna Conteudo já filtrado

	* Atributos necessários
	* Valor para $typeRequisition:
	* 1 - GET
	* 2 - POST
	* 3 - COOKIE
	* 4 - SERVER
	* 5 - ENV
	*/

	public static function filter (
	    int $typeRequisition,
        string $nameVar,
        int $typeOfFilter = FILTER_SANITIZE_SPECIAL_CHARS
    ){

		return filter_input(self::getTypeRequisition($typeRequisition), $nameVar, $typeOfFilter);

	}

	/*
	* Função privada que retorna qual o tipo de reuisição o sistema está enviando.
	*/
	private static function getTypeRequisition (int $typeRequisition) {

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
