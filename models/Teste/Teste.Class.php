<?php namespace Teste;


use Tools\DATABASE as DATABASE;
use Tools\ModelTools as ModelTools;
use Engine as Engine;


class Teste extends Engine\model
{

	public function callTeste () {

		return $this->gettDatabaseInfo()->fetchAll();

	}

	private function gettDatabaseInfo () {

		return self::$DATABASE_SELECT->query (['*'], ['produto_imp_arquivo'], [], ['id', '>', 125]);

	}


}