<?php namespace Models\Tools\Database;
/*
* Classe com o único intuito de atualizar dados já existentes na DATABASE.
* Usará como parâmetros: "tableTerms", "tableNames", "conditionTerms".
* O termo "conditionTerms" será obrigatórios a fim de preservar a integridade do banco.
* Esta classe é filha da Classe DATABASE_TOOLS
*
*/

/**
 * Class DATABASE_UPDATE
 * @package Models\Tools\Database
 * @author Daniel Fiedler
 */
class DATABASE_UPDATE extends DATABASE_TOOLS
{

    /*
    * Os atributos da classe DATABASE_UPDATE
    * O atributo "tableNames" faz referência a qual tabela será alvo do UPDATE
    * O atributo "tableTerms" faz referência a quais elementos serão atualizados.
    * O atributo "valueTerms" faz referência aos valores que serão usados no update.
    * O atributo "conditionTerms" faz referência às condições da atualização. 
    */

    /**
     * Função que irá gerar os valores para o tipo UPDATE
     * @param array $tableNames
     * @param array $tableTerms
     * @param array $valueTerms
     * @param array $conditionTerms
     * @return string
     */
    private function generateQuery (array $tableNames,
                                    array $tableTerms,
                                    array $valueTerms,
                                    array $conditionTerms) : string {

        return
            'UPDATE '
            .self::generateTerms ($tableNames)
            .' SET ('.self::generateTerms ($tableTerms)
            .') = ('
            .self::generateTerms ($valueTerms).')'
            .self::additionalTerms ($conditionTerms);

    }

    /**
     * Aqui a chamada da query normal da classe UPDATE
     * @param array $tableNames
     * @param array $tableTerms
     * @param array $valueTerms
     * @param array $conditionTerms
     * @return bool|mixed
     */
    public function query (array $tableNames,
                          array $tableTerms,
                          array $valueTerms,
                          array $conditionTerms) {

        if (!$this->isConditionEmptyOrInvalid($conditionTerms)) {

            return
                self::runQuery(

                    self::generateQuery($tableNames, $tableTerms, $valueTerms,$conditionTerms)

                );

        }

        return false;

    }

    /*
    * Metodos que chamarão a função Prepare presente em alguns dos métodos da classe DATABASE_RUN
    *
    */

    /**
     * Função que iniciará o prepare para UPDATE
     * @param array $tableNames
     * @param array $tableTerms
     * @param array $valueTerms
     * @param array $conditionTerms
     * @return bool|mixed
     */
    public function prepare (array $tableNames,
                            array $tableTerms,
                            array $valueTerms,
                            array $conditionTerms) {

        if (!$this->isConditionEmptyOrInvalid ($conditionTerms)) {

            return self::initPrepare(

                self::generateQuery ($tableNames, $tableTerms, $valueTerms,$conditionTerms)

            );

        }

        return false;

    }

    /**
     * Função que executará o prepare
     * @param array $valueTerms
     * @param array $conditionTerms
     * @return bool
     */
    public function execute (array $valueTerms, array $conditionTerms) : bool {

        if (!$this->isConditionEmptyOrInvalid($conditionTerms)) {

            return self::runPrepare (

                array_merge($valueTerms,$conditionTerms)

            );

        }   

        return false;

    }


}