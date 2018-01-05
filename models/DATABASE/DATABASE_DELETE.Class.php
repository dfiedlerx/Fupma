<?php namespace DATABASE;
/*
* Esta classe tem como objetivo deletar dados na DATABASE
* É uma classe que exige cuidados acima do normal. Em detrimento disso, as verificações são maiores.
* Classe filha da classe DATABASE_TOOLS
*
*/

/**
 * Class DATABASE_DELETE
 * @package DATABASE
 */
class DATABASE_DELETE extends DATABASE_TOOLS{

	/*
    * Os atributos da classe DATABASE_DELETE
    * O atributo "tableNames" faz referência as tabelas que serão alvos da remoção.
    * O atributo "conditionTerms" faz referência às condições da remoção. 
    */

    /**
     * Função que irá gerar os valores para o tipo DELETE
     * @param array $tableNames
     * @param array $conditionTerms
     * @return string
     */
    private function generateQuery (array $tableNames, array  $conditionTerms) {

    	return
            'DELETE FROM '
            .self::generateTerms ($tableNames)
            .self::additionalTerms ($conditionTerms);

    }

    /**
     * Aqui a chamada da query normal da classe DELETE
     * @param array $tableNames
     * @param array $conditionTerms
     * @return mixed
     */
    public function query (array $tableNames,  array $conditionTerms) {

        return
            !$this->isConditionEmptyOrInvalid ($conditionTerms)
                ? self::runQuery(self::generateQuery($tableNames, $conditionTerms))
                : false;

    }

    /*
    * Metodos que chamarão a função Prepare presente em alguns dos métodos da classe DATABASE_RUN
    *
    */

    /**
     * Função que iniciará o prepare para DELETE
     * @param array $tableNames
     * @param array $conditionTerms
     * @return mixed
     */
    public function prepare(array $tableNames,  array $conditionTerms){

        return
            !$this->isConditionEmptyOrInvalid ($conditionTerms)
                ? self::initPrepare(self::generateQuery($tableNames, $conditionTerms))
                : false;

    }

    /**
     * Função que executará o prepare
     * @param array $conditionTerms
     * @return mixed
     */
    public function execute (array $conditionTerms) {

        return
            !$this->isConditionEmptyOrInvalid($conditionTerms)
                ? self::runPrepare($conditionTerms)
                : false;

    }

}    


