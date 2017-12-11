<?php

	/* Classe: DATABASE_TOOLS
	*
	* Classe que terá como intuito a contenção dos métodos úteis a qualquer classe de INSERT, DELETE, UPDATE, JOIN, etc;
	* Faz-se referência a qualquer tipo de utilidade que uma ação no banco precisa.
	* Classe filha da classe DATABASE_RUN.
	* Esta classe nao possui comunicação com outras classes do sistema.
	*
	*/

       	abstract class DATABASE_TOOLS extends DATABASE_QUERY_GENERATE
        {

		/*
		* Primeiro virão os métodos de tratamento de uma query.
		* Ex: Número de resultados, Ultimo ID, etc.
		*
	----------------------------------------------------------------------------------------------- */

		/*
		* Método que retorna o ID do último item adicionado em uma determinada tabela.
		* Como o banco escolhido no momento foi o PostgreSQL, será nescessário informar o nome
		* sequencial da tabela para que o retorno do id funcione.
		*
		*/
		public function getLastInsertId ($sequenceName) {
			
			return self::$DB_CONNECTION->lastInsertId($sequenceName);

		}

		/*
		* Método que retornará o número de elementos que determinada query resultou.
		* Deve-se ser passado a variavel que contém o resultado da query;
		*
		*/

		public function getNumOfElements ($queryResult) {

			if (!is_bool($queryResult)) {
			
				return $queryResult->rowCount();
			
			}

			return FALSE;

		}	

		/*
		* Verifica se a query retornou ou não ao menos um resultado.
		* Retorna TRUE ou FALSE;
		*
		*/

		public function verifIfExistsOneOrMoreElements ($queryResult) {

			return self::getNumOfElements($queryResult) > 0;

		}

		/*
		* Retorna um array com apenas um resultado.
		* A explicação do porque se usar esse metodo aqui e nao apenas lançar a fetch() diretamente é que
		* no futuro, caso a classe venha a ser trocada, a manutenção vai ser facilmente feita.
		*
		*/

		public function getFetchArray ($queryResult) {

			return $queryResult->fetch();

		}

		/*
		* Retorna um array com todos os resultados.
		* A explicação do porque se usar esse metodo aqui e nao apenas lançar a fetchAll() diretamente é que
		* no futuro, caso a classe venha a ser trocada, a manutenção vai ser facilmente feita.
		*
		*/

		public function getFetchAllArray ($queryResult) {

			return $queryResult->fetchAll();

		}


    	//Método que verifica se o parametro pra se formar o Where foram 

    	protected function isConditionEmptyOrInvalid ($conditionTerms) {

        	return 
        	$conditionTerms == '' || 
        	$conditionTerms == array() || 
        	empty($conditionTerms) || 
        	!is_array($conditionTerms);

    	}    

	}

