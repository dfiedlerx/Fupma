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
 *      GlobalValue::set('chave1->chave2->chave3', 'valor de exemplo');
 *      Cria-se o caminho ['chave1' => 'chave2' => ['chave3' => 'valor de exemplo']]
 *  Pode-se também alterar o '->' para outro separador caso nescessário
 *
 *      GlobalValue::set('->|algo->|chave3', 'valor de exemplo exemplo', '|');
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

        eval('$keyPath = self::$globalCase'.self::concatKeyPath($keyPath, $pathSeparator).';');
        return $keyPath;

    }

    /**
     * Seta um valor a GlboalValue para ser acessado de outros locais do sitema.
     *
     * @param string $keyPath
     * @param $value
     * @param string $pathSeparator
     *
     */
    public static function set (string $keyPath = '', $value, string $pathSeparator = '->') {

        eval('self::$globalCase'.self::concatKeyPath($keyPath, $pathSeparator).' = $value;');

    }

    /**
     * @param string $keyPath
     * @param string $pathSeparator
     */
    public static function unset (string $keyPath = '', string $pathSeparator = '->') {

        eval('unset(self::$globalCase'.self::concatKeyPath($keyPath, $pathSeparator).');');

    }

    /**
     * Gera o caminho de array comn base nos parametros passados.
     *
     * @Example
     *
     *  'config->database->default->dbName'
     *  se torna
     *  ['config']['database']['dafault']['dbName']
     *
     * @param string $keysPath
     * @param string $pathSeparator
     * @return string
     */
    private static function concatKeyPath (string $keysPath, string $pathSeparator) : string {

        if ($keysPath == '') return '';

        $convertedKeys = '';

        foreach (explode($pathSeparator, $keysPath) as $keyName) {

            $convertedKeys .= "['".$keyName."']";

        }

        return $convertedKeys;

    }

    /**
     * Retorna um booleano informando se caminho global foi criado.
     *
     * @param string $keyPath
     * @param string $pathSeparator
     * @return bool
     */
    public static function exists (string $keyPath = '', string $pathSeparator = '->') : bool {

        eval('$keyPath = isset(self::$globalCase'.self::concatKeyPath($keyPath, $pathSeparator).');');
        return $keyPath;

    }

}