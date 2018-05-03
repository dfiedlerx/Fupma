<?php namespace Models\Tools\Basic;


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
 *      GlobalValue::set('chave1->chave2->chave3', 'valor de exemplo');
 *      Cria-se o caminho ['chave1' => 'chave2' => ['chave3' => 'valor de exemplo']]
 *  Pode-se também alterar o '->' para outro separador caso nescessário
 *
 *      GlobalValue::set('->|algo->|chave3', 'valor de exemplo exemplo', '|');
 *      Cria-se o caminho ['->' => 'algo->' => ['chave3' => 'valor de exemplo exemplo']]
 *
 *  O uso das demais funções utiliza do mesmo método de chaves de array respectivamente.
 *
 * @package Models\Tools\Basic
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
    public static function get (string $keyPath, string $pathSeparator = '->') {

        $keyPath = explode ($pathSeparator, $keyPath);

        $rgResult = self::$globalCase[$keyPath['0']];
        unset($keyPath['0']);

        foreach ($keyPath as $keyName) {

            $rgResult = $rgResult[$keyName];

        }

        return $rgResult;

    }

    /**
     * TODO: A variavel $value está sendo usada dentro da função eval
     *
     * @param string $keyPath
     * @param $value
     * @param string $pathSeparator
     */
    public static function set (string $keyPath, $value, string $pathSeparator = '->') {

        $keyPath = self::concatKeyPath(explode ($pathSeparator, $keyPath));
        eval('self::$globalValue'.$keyPath.' = $value;');

    }

    /**
     * @param string $keyPath
     * @param string $pathSeparator
     */
    public static function unset (string $keyPath, string $pathSeparator = '->') {

        $keyPath = self::concatKeyPath(explode ($pathSeparator, $keyPath));
        eval('unset(self::$globalValue'.$keyPath.');');

    }

    /**
     * @param array $keyArray
     * @return string
     */
    private static function concatKeyPath (array $keyArray) : string {

        $convertedKeys = '';

        foreach ($keyArray as $keyName) {

            $convertedKeys .= "['".$keyName."']";

        }

        return $convertedKeys;

    }

    /**
     * @param string $keyPath
     * @param string $pathSeparator
     * @return bool
     */
    public static function exists (string $keyPath, string $pathSeparator = '->') {

        $keyPath = explode ($pathSeparator, $keyPath);
        $rgResult = [];

        foreach ($keyPath as $number => $keyName) {

            if ($number == 0) {

                if (!isset(self::$globalCase[$keyName])) {

                    return false;

                }

                $rgResult = self::$globalCase[$keyName];

            } else {

                if (!isset($rgResult[$keyName])) {

                    return false;

                }

                $rgResult = $rgResult[$keyName];

            }

        }

        return true;

    }

}