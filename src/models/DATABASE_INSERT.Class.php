<?php

/*
* 
* Classe que ficará encarregada de realizar Inserts no banco de Dados.
* CLasse que será filha da classe DATABASe_TOOLS.
* Esta classe faz relação com outras classes.
*
*
*/
namespace \DATABASE;

class DATABASE_INSERT extends DATABASE_TOOLS{

    /*
    * Os atributos da classe DATABASE_INSERT
    * O atributo "tableNames" faz referência a qual tabela será alvo do INSERT
    * O atributo "tableTerms" faz referência aos elementos da Tabela
    * O atributo "valueTerms" faz referência aos valores que serão usados no update.
    *
    */

    /*
    * Função que irá gerar a query do tipo INSERT
    *
    */

    private function generateQuery ($tableNames, $tableTerms, $valueTerms){

        return
            'INSERT INTO '
            .self::generateTerms($tableNames)
            ." (".self::generateTerms($tableTerms)
            .") VALUES "
            .self::generateValuesString($valueTerms);

    }

    //Função que gera os valores a serem inseridos. Podendo ser de um a indefinido.
    private function generateValuesString ($valueTerms) {

        $valuesString = '';
        $currentElement = 0;
        $arrayCount = count($valueTerms);

        foreach ($valueTerms as $currentValues) {

            $currentElement += 1;
            $valuesString .= ' ('.self::generateTerms($currentValues).')';

            if ($currentElement < $arrayCount){

                $valuesString.= ' ,';

            }
        }

        return $valuesString;

    }

     /*
    * Aqui a chamada da query normal da classe UPDATE
    *
    */

    public function query($tableNames, $tableTerms, $valueTerms){

        return
            self::runQuery(

                self::generateQuery($tableNames, $tableTerms, $valueTerms)

            );

    }

    /*
    * Metodos que chamarão a função Prepare presente em alguns dos métodos da classe DATABASE_RUN
    *
    */

    //Função que iniciará o prepare para UPDATE

    public function prepare($tableNames, $tableTerms, $valueTerms){

        return
            self::initPrepare(

                self::generateQuery($tableNames, $tableTerms, $valueTerms)

            );

    }

    //Função que executará o prepare

    public function execute($valueTerms){

        return self::runPrepare($valueTerms);

    }


}

