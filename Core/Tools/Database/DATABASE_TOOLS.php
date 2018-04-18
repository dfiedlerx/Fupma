<?php namespace Core\Tools\DATABASE;
/* Classe: DATABASE_TOOLS
*
* Classe que terá como intuito a contenção dos métodos úteis a qualquer classe de INSERT, DELETE, UPDATE, JOIN, etc;
* Faz-se referência a qualquer tipo de utilidade que uma ação no banco precisa.
* Classe filha da classe DATABASE_RUN.
* Esta classe nao possui comunicação com outras classes do sistema.
*
*/

use PDO;
use PDOStatement;

/**
 * Class DATABASE_TOOLS
 * @package DATABASE
 * @author Daniel Fiedler
 */
abstract class DATABASE_TOOLS extends DATABASE_QUERY_GENERATE
{

    /*
    * Primeiro virão os métodos de tratamento de uma query.
    * Ex: Número de resultados, Ultimo ID, etc.
    *
    ----------------------------------------------------------------------------------------------- */

    /**
     * Método que retorna o ID do último item adicionado em uma determinada tabela.
     * Caso o banco escolhido no momento seja o PostgreSQL, será nescessário informar o nome
     * sequencial da tabela para que o retorno do id funcione.
     *
     * @param string $sequenceName
     * @return mixed
     */
    public function getLastInsertId (string $sequenceName = '') {

        return
            $sequenceName === ''
                ? self::$DB_CONNECTION->lastInsertId ()
                : self::$DB_CONNECTION->lastInsertId($sequenceName);

    }

    /**
     *  Método que retornará o número de elementos que determinada query resultou.
     * Deve-se ser passado a variavel que contém o resultado da query;
     * @param $queryResult PDOStatement
     * @return bool
     */
    public function getNumOfElements ($queryResult) : bool {

        return
            !is_bool($queryResult)
                ? $queryResult->rowCount()
                : false;

    }

    /**
     * Verifica se a query retornou ou não ao menos um resultado.
     * @param $queryResult
     * @return bool
     */
    public function verifIfExistsOneOrMoreElements ($queryResult) : bool {

        return self::getNumOfElements($queryResult) > 0;

    }

    /**
     * Retorna um array com apenas um resultado.
     * A explicação do porque se usar esse metodo aqui e nao apenas lançar a fetch() diretamente é que
     * no futuro, caso a classe venha a ser trocada, a manutenção vai ser facilmente feita.
     *
     * @param $queryResult PDOStatement
     * @return array
     */
    public function getFetchArray ($queryResult) : array {

        return
            !is_bool($queryResult)
                ? $queryResult->fetch(PDO::FETCH_ASSOC)
                : [];

    }

    /**
     * Retorna um array com todos os resultados.
     * A explicação do porque se usar esse metodo aqui e nao apenas lançar a fetchAll() diretamente é que
     * no futuro, caso a classe venha a ser trocada, a manutenção vai ser facilmente feita.
     *
     * @param $queryResult PDOStatement
     * @return mixed
     */
    public function getFetchAllArray ($queryResult) : array {

        return
            !is_bool ($queryResult)
                ? $queryResult->fetchAll(PDO::FETCH_ASSOC)
                : [];

    }

    /**
     * Método que verifica se o parametro pra se formar o Where foram realmente preenchidos e existem.
     * @param $conditionTerms
     * @return bool
     */
    protected function isConditionEmptyOrInvalid ($conditionTerms) : bool {

        return
            $conditionTerms == '' ||
            $conditionTerms == array() ||
            empty($conditionTerms) ||
            !is_array($conditionTerms) ||
            is_null ($conditionTerms);

    }

}

