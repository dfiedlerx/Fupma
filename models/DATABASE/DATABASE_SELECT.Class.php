<?php namespace DATABASE;
/*Esta classe tem como objetivo trazer dados da DATABASE
* Esta classe só poderá ser utilizada quando os dados retornados nao dependerem de alguma coorelação com outras tabelas.
* No caso citado acima, a classe que deverá ser utilizada é a DATABASE_JOIN
* Esta classe é filha da classe DATABASE_TOOLS
*/

/**
 * Class DATABASE_SELECT
 * @package DATABASE
 */
class DATABASE_SELECT extends DATABASE_TOOLS{

    /*
    * Os atributos da classe DATABASE_SELECT
    * O atributo "tableTerms" faz referência a quais elementos serão pesquisados.
    * O atributo "tableNames" faz referência as tabelas que serão usadas na pesquisa.
    * O atributo "conditionTerms" faz referência às condições da pesquisa. 
    * O atributo "limitTerms" faz referência à alguma possivel limitação que for necessária.
    * O atributo "orderTerms" faz referência à alguma possível necessidade de ORDER.
    */

    /**
     *  Função que irá gerar os valores para o tipo SELECT
     * @param array $tableTerms
     * @param array $tableNames
     * @param array $joinTerms
     * @param array $conditionTerms
     * @param array $orderTerms
     * @param array $limitTerms
     * @return string
     */
    private function generateQuery (array $tableTerms,
                                    array $tableNames,
                                    array $joinTerms = array(),
                                    array $conditionTerms = array(),
                                    array $orderTerms = array(),
                                    array $limitTerms = array()) {

    	return
            'SELECT '
            .self::generateTerms($tableTerms)
            .' FROM '.self::generateTerms($tableNames)
            .self::generateJoinTerms ($joinTerms)
            .self::additionalTerms($conditionTerms,$orderTerms,$limitTerms);

    }

    /**
     * @param array $joinTerms
     * @return string
     */
    private function generateJoinTerms (array $joinTerms) {

        $joinStringToReturn = ' ';

        foreach ($joinTerms as $currentJoinTerm) {

            $joinStringToReturn .=
                $currentJoinTerm['0']
                .' ON ('
                .self::generateConditionTerms($currentJoinTerm['1'])
                .') ';

        }

        return $joinStringToReturn;

    }

    /**
     * Aqui a chamada da query normal da classe SELECT
     * @param array $tableTerms
     * @param array $tableNames
     * @param array $joinTerms
     * @param array $conditionTerms
     * @param array $orderTerms
     * @param array $limitTerms
     * @return mixed
     */
    public function query(array $tableTerms,
                          array $tableNames,
                          array $joinTerms = array(),
                          array $conditionTerms = array(),
                          array $orderTerms=array(),
                          array $limitTerms=array()){

    	return
            self::runQuery(

                self::generateQuery($tableTerms, $tableNames, $joinTerms, $conditionTerms,$orderTerms,$limitTerms)

            );

    }

    /*
    * Metodos que chamarão a função Prepare presente em alguns dos métodos da classe DATABASE_RUN
    *
    */

    /**
     * Função que iniciará o prepare para SELECT
     * @param array $tableTerms
     * @param array $tableNames
     * @param array $joinTerms
     * @param array $conditionTerms
     * @param array $orderTerms
     * @param array $limitTerms
     * @return mixed
     */
    public function prepare(array $tableTerms,
                            array $tableNames,
                            array $joinTerms = [],
                            array $conditionTerms = [],
                            array $orderTerms = [],
                            array $limitTerms = []){

    	return
            self::initPrepare(

                self::generateQuery($tableTerms, $tableNames, $joinTerms, $conditionTerms,$orderTerms,$limitTerms)

            );

    }

    /**
     * Função que executará o prepare
     * @param array $conditionValues
     * @param array $orderValues
     * @param array $limitValues
     * @return bool
     */
    public function execute(array $conditionValues = [],
                            array $orderValues = [],
                            array $limitValues = []){

    	return
            self::runPrepare(

                $conditionValues
                + $orderValues
                + $limitValues

            );

    }

}


