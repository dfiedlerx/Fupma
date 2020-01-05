<?php namespace System\Models\Tools\Basic;


/**
 * Class GlobalValue
 *
 * A classe abaixo foi criada para prover um modo global organizado para se acessar valores de diversos locais do
 * sistema.
 *
 * @usage
 *  A classe possui os métodos get(obter valor), set(salvar valor), unset(deletar valor) e exists (verifica se valor
 *  existe).
 *
 *  Deve-se atribuir valores por meio de chaves de array, mas elas deverão ser passadas como o exemplo abaixo:
 *      GlobalValue::set('valor de exemplo', 'chave1->chave2->chave3');
 *      Cria-se o caminho ['chave1' => 'chave2' => ['chave3' => 'valor de exemplo']]
 *  Pode-se também alterar o '->' para outro separador caso nescessário
 *
 *      GlobalValue::set('valor de exemplo exemplo', '->|algo->|chave3', '|');
 *      Cria-se o caminho ['->' => 'algo->' => ['chave3' => 'valor de exemplo exemplo']]
 *
 *  O uso das demais funções utiliza do mesmo método de chaves de array respectivamente.
 *
 * @package System\Models\Tools\Basic
 * @author Daniel Fiedler
 */
class GlobalValue
{

    //Esta variável estática comportará todas as variaveis globais do sistema.
    private static $globalCase = [];

    /**
     * @param string $keyPath
     * @param string $pathSeparator
     * @return mixed
     */
    public static function get (string $keyPath = '', string $pathSeparator = '->') {

        if ($keyPath == '') {

            return self::$globalCase;

        }

        $parts = explode($pathSeparator, $keyPath);
        $arrayValue = self::$globalCase;

        foreach($parts as $part) {

            if(!isset($arrayValue[$part])) {

                return 'UNDEFINED';

            }

            $arrayValue = $arrayValue[$part];

        }

        return $arrayValue;

    }

    /**
     * Seta um valor em $globalCase para ser acessado de outros locais do sitema.
     *
     * @param string $keyPath
     * @param $value
     * @param string $pathSeparator
     *
     */
    public static function set ($value, string $keyPath = '', string $pathSeparator = '->') {

        if ($keyPath == '') {

            self::$globalCase = $value;
            return;

        }

        $parts = explode($pathSeparator, $keyPath);
        $tempArray =  &self::$globalCase;

        foreach($parts as $part) {

            if(!isset($tempArray[$part])) {
                $tempArray[$part] = [];
            }

            $tempArray = &$tempArray[$part];
        }

        $tempArray = $value;

    }

    /**
     * @param string $keyPath
     * @param string $pathSeparator
     */
    public static function unset (string $keyPath = '', string $pathSeparator = '->') {

        if ($keyPath == '') {

            self::$globalCase = null;
            return;

        }

        $parts = explode($pathSeparator, $keyPath);
        $lastTerm = array_pop($parts);

        $tempArray =  &self::$globalCase;

        foreach($parts as $part) {

            if(!isset($tempArray[$part])) {
                return;
            }

            $tempArray = &$tempArray[$part];
        }

        unset($tempArray[$lastTerm]);

    }

    /**
     * Retorna um booleano informando se caminho global foi criado.
     *
     * @param string $keyPath
     * @param string $pathSeparator
     * @return bool
     */
    public static function exists (string $keyPath = '', string $pathSeparator = '->') : bool {

        $parts = explode($pathSeparator, $keyPath);
        $arrayValue = self::$globalCase;

        foreach($parts as $part) {

            if(!isset($arrayValue[$part])) {

                return false;

            }

            $arrayValue = $arrayValue[$part];

        }

        return true;

    }

}