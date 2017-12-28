<?php

/*Esta classe tem como objetivo trazer dados da DATABASE
* Esta classe só poderá ser utilizada quando os dados retornados nao dependerem de alguma coorelação com outras tabelas.
* No caso citado acima, a classe que deverá ser utilizada é a DATABASE_JOIN
* Esta classe é filha da classe DATABASE_TOOLS
*/
namespace \DATABASE;

class DATABASE_SELECT extends DATABASE_TOOLS{

    /*
    * Os atributos da classe DATABASE_SELECT
    * O atributo "tableTerms" faz referência a quais elementos serão pesquisados.
    * O atributo "tableNames" faz referência as tabelas que serão usadas na pesquisa.
    * O atributo "conditionTerms" faz referência às condições da pesquisa. 
    * O atributo "limitTerms" faz referência à alguma possivel limitação que for necessária.
    * O atributo "orderTerms" faz referência à alguma possível necessidade de ORDER.
    */

    
    /*
    * Função que irá gerar os valores para o tipo SELECT
    *
    */

    private function generateQuery ($tableTerms, $tableNames, 
        $conditionTerms = array(), 
        $orderTerms = array(), 
        $limitTerms = array()) {

    	return
            'SELECT '
            .self::generateTerms($tableTerms)
            .' FROM '.self::generateTerms($tableNames)
            .self::additionalTerms($conditionTerms,$orderTerms,$limitTerms);

    }

    /*
    * Aqui a chamada da query normal da classe SELECT
    *
    */

    public function query($tableTerms, $tableNames, $conditionTerms = array(),$orderTerms=array(),$limitTerms=array()){

    	return
            self::runQuery(

                self::generateQuery($tableTerms, $tableNames, $conditionTerms,$orderTerms,$limitTerms)

            );

    }

    /*
    * Metodos que chamarão a função Prepare presente em alguns dos métodos da classe DATABASE_RUN
    *
    */

    //Função que iniciará o prepare para SELECT

    public function prepare($tableTerms, $tableNames, $conditionTerms = array(),$orderTerms=array(),$limitTerms=array()){

    	return
            self::initPrepare(

                self::generateQuery($tableTerms, $tableNames, $conditionTerms,$orderTerms,$limitTerms)

            );

    }

    //Função que executará o prepare

    public function execute($conditionValues = array(), $orderValues = array(), $limitValues = array()){

    	return
            self::runPrepare(

                array_merge($conditionValues,$orderValues,$limitValues)

            );

    }


}


