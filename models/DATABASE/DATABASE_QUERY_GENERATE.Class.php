<?php namespace DATABASE;
/*
* Essa classe é encarregada de gerar as strings que serão usadas
* nas consultas ao Banco de Dados.
* Classe Filha da Classe DATABASE_RUN e mãe da Classe DATABASE_TOOLS.
*
*/


abstract class DATABASE_QUERY_GENERATE extends DATABASE_RUN{

	/*
	* Os métodos desta primeira parte são direcionados a classe query();
	*
---------------------------------------------------------------------------------------------------------*/

	/* Classe que irá implementar nas strings as tabelas alvo. Deverão ser passados em um array.
	* Ex: array ('work', 'aluno', 'sem_ideias', 'etc') gera work,aluno,sem_ideias,etc;
	* Servirá para o nome das tabelas, os atributos delas, Order By e Limit By.
	* O segundo parametro é o conector que ficará entre os termos. Nesse caso o padrão sera o ','
	*
	*/
	protected function generateTerms(array $tableTerms, string $intoTerms = ',') {

		return implode ($intoTerms,$tableTerms);

	}

    //Função que retorna possíveis itens adicionais que foram solicitados. Sendo eles: Order, Limit e WHERE
    protected function additionalTerms (array $conditionTerms = array(),
                                        array $orderTerms = array(), array $limitTerms = array()) {

        $additionalTerms = "";

        if (!empty($conditionTerms)) {

            $additionalTerms .= " WHERE ".self::generateConditionTerms($conditionTerms);

        }

        if (!empty($orderTerms)) {

            $additionalTerms .= " ORDER BY ".self::generateTerms($orderTerms, ' ');

        }

        if (!empty($limitTerms)) {

            $additionalTerms .= " LIMIT ".$limitTerms[0]." OFFSET ". $limitTerms[1];

        }

        return $additionalTerms;

    }


    /* Função que irá gerar os termos de um where.
    * Será passada uma matriz em que:
    * A chave dessa matriz fará referência ao Nome do primeiro termo.
    * O conteúdo desta chave será dois valores no qual o primeiro diz referência à condição de igualdade com o primeiro termo e
    * o segundo é o conectivo com o próximo sendo ele 'AND', 'OR', etc.
    * EX:
    * array (
    *  array ('chave1','=','cavalo', 'AND'),
    *  array ('chave2,'=','Mula', 'OR'),
    *  array ('chave3','=','Louco', '')
    * );
    * O resultado sairá: chave1 = cavalo AND chave2 = Mula OR chave3 = Louco
    * Note que o último termo tem conectivo vazio já que não haverá mais com o que conectar.
    */
    private function generateConditionTerms(array $terms) {

        $preString = '';

        if (!empty($terms)){

            foreach ($terms as $currentTerm) {

                $preString .= ' '.self::generateTerms($currentTerm, ' ');

       		}

        }

        return $preString;

    }

}
