<?php

/* Classe que é encarregada de encaminhar as querys para execução no banco.
* Essa classe é filha da classe DATABASE_CONNECTION e mãe da Classe DATABASE_TOOLS.
* Nao há necessidade de comunicação com outras calsses do sistema.
*
*/
namespace DATABASE;

abstract class DATABASE_RUN extends DATABASE_CONNECTION
{

	//Atributo que comportará uma determinada prepare.
	protected $DB_PREPARE;

	/*
	* Método de uso da propriedade query.
	* Esse método exige filtragem prévia dos dados e é melhor utilizada quando não for preciso multiplas consultas.
	*
	*/

	protected function runQuery ($queryString) {

		return self::$DB_CONNECTION->query($queryString);

	}

	/*
	* Métodos de uso da propriedade Prepare.
	* É recomendado úsá-la sempre que possível, salvo em casos em que os dados já tenham sido filtrados e não haverá
	* múltiplas consultas.
	*
	*/

	//Função que inicia o prepare para ser usado;
	protected function initPrepare ($prepareString) {

		$this->DB_PREPARE = self::$DB_CONNECTION->prepare($prepareString);
		return $this->DB_PREPARE;

	}

	//Função que executará algo no prepare. O parâmetro de ser um array.
	protected function runPrepare ($execArrayParameters = array()) {

		if (is_array($execArrayParameters)){

			$this->DB_PREPARE->execute ($execArrayParameters);
			return $this->DB_PREPARE;

		}

		return false;

	}

}