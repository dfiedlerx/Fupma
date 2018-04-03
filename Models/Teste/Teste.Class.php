<?php namespace Models\Teste;


use Core\Engine as Engine;


class Teste extends Engine\model
{

	public function callTeste () {

		return $this->getDatabaseInfo()->fetchAll();

	}

	private function getDatabaseInfo () {

		return self::$DATABASE_SELECT->query (['*'], ['produto_imp_arquivo'], [], ['id', '>', 125]);

	}


}