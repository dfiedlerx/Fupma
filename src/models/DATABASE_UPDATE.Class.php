<?php

/*
* Classe com o único intuito de atualizar dados já existentes na DATABASE.
* Usará como parâmetros: "tableTerms", "tableNames", "conditionTerms".
* O termo "conditionTerms" será obrigatórios a fim de preservar a integridade do banco.
* Esta classe é filha da Classe DATABASE_TOOLS
*
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

    /*
    * Função que irá gerar os valores para o tipo UPDATE
    *
    */

    private function generateQuery ($tableNames, $tableTerms, $valueTerms,$conditionTerms) {

        return 'UPDATE '.self::generateTerms ($tableNames).' SET ('.self::generateTerms ($tableTerms).') = ('.self::generateTerms ($valueTerms).')'.self::additionalTerms ($conditionTerms);

    }

    /*
    * Aqui a chamada da query normal da classe UPDATE
    *
    */

    public function query($tableNames, $tableTerms, $valueTerms,$conditionTerms){

        if (!$this->isConditionEmptyOrInvalid($conditionTerms)) {

            return self::runQuery(self::generateQuery($tableNames, $tableTerms, $valueTerms,$conditionTerms));

        }

        return FALSE;

    }

    /*
    * Metodos que chamarão a função Prepare presente em alguns dos métodos da classe DATABASE_RUN
    *
    */

    //Função que iniciará o prepare para UPDATE

    public function prepare($tableNames, $tableTerms, $valueTerms,$conditionTerms){

        if (!$this->isConditionEmptyOrInvalid ($conditionTerms)) {

            return self::initPrepare(self::generateQuery ($tableNames, $tableTerms, $valueTerms,$conditionTerms));

        }

        return FALSE;   
    }

    //Função que executará o prepare

    public function execute($valueTerms, $conditionTerms){

        if (!$this->isConditionEmptyOrInvalid($conditionTerms)) {

            return self::runPrepare (array_merge($valueTerms,$conditionTerms));

        }   

        return FALSE;
    }


}