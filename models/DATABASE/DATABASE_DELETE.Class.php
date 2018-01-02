<?php namespace DATABASE;
/*
* Esta classe tem como objetivo deletar dados na DATABASE
* É uma classe que exige cuidados acima do normal. Em detrimento disso, as verificações são maiores.
* Classe filha da classe DATABASE_TOOLS
*
*/


class DATABASE_DELETE extends DATABASE_TOOLS{
	/*
    * Os atributos da classe DATABASE_DELETE
    * O atributo "tableNames" faz referência as tabelas que serão alvos da remoção.
    * O atributo "conditionTerms" faz referência às condições da remoção. 
    */

    /*
    * Função que irá gerar os valores para o tipo DELETE
    *
    */
    private function generateQuery (array $tableNames, array  $conditionTerms) {

    	return
            'DELETE FROM '
            .self::generateTerms ($tableNames)
            .self::additionalTerms ($conditionTerms);

    }

    /*
    * Aqui a chamada da query normal da classe DELETE
    *
    */

    public function query (array $tableNames,  array $conditionTerms) {

        if (!$this->isConditionEmptyOrInvalid ($conditionTerms)){

            return
                self::runQuery(

                    self::generateQuery($tableNames, $conditionTerms)

                );

        }

        return false;
    }

    /*
    * Metodos que chamarão a função Prepare presente em alguns dos métodos da classe DATABASE_RUN
    *
    */

    //Função que iniciará o prepare para DELETE

    public function prepare(array $tableNames,  array $conditionTerms){

        if (!$this->isConditionEmptyOrInvalid ($conditionTerms)){

            return self::initPrepare(

                self::generateQuery($tableNames, $conditionTerms)

            );

        }

        return false;
    }


    //Função que executará o prepare

    public function execute (array $conditionTerms) {

        if (!$this->isConditionEmptyOrInvalid($conditionTerms)){

            return self::runPrepare($conditionTerms);

        }   

        return false;
    }

}    


