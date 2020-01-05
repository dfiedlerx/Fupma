<?php namespace System\Models\Tools\Basic;


/**
 * Class StringC
 * @package System\Models\Tools\Basic
 * @author Daniel Fiedler
 */
class StringC
{

    /**
     * Verifica se uma string possui exatamento o tamanho especificado.
     *
     * @param string $suspect
     * @param int $quantity
     * @return int
     */
    public static function isTheStrLenght (string $suspect, int $quantity) : int {

        return strlen ($suspect) == $quantity;

    }

    /**
     * Substitui um determinado termo de uma string por outro escolhido.
     *
     * @param string $indictee
     * @param $tax
     * @param $payBack
     * @return string
     */
    public static function subsStrTerm (string $indictee, $tax, $payBack) : string {

        return str_replace ($tax, $payBack, $indictee);

    }

    /**
     * Verifica se determinado termo existe em uma string.
     *
     * @param $suspect
     * @param $search
     * @return bool
     */
    public static function existsStrTerm ($suspect, $search) : bool {

        return strpos ($suspect, $search) > -1;

    }

    public static function removeAllAfterTerm ($termToSearch, $stringToRemove) : string {

        $termPos = self::getTermPos($termToSearch, $stringToRemove);

        if (!is_bool($termPos)) {

            $stringToRemove = self::splitString($stringToRemove, 0, $termPos);

        }

        return $stringToRemove;

    }

    public static function splitString (string $string, int $ini, int $end) : string {

        return substr($string, $ini, $end);

    }

    /**
     * Retorna o número de vezes que determinado termo aparece em uma string.
     *
     * @param string $suspect
     * @param string $soughtTerm
     * @return int
     */
    public static function termOcurrenceCount (string $suspect,string $soughtTerm) : int {

        return substr_count($suspect, $soughtTerm);

    }

    /**
     * Tranforma uma string em uma máscara personalizada de acordo com a necessidade. O caracter de substituição padrão
     * é o '#'
     *
     * @Usage
     *       Tools\ModelTools\StringC::changeStringToMask ('23041997', '##/##/####');
     *          output: 23/04/1997
     *       Tools\ModelTools\StringC::changeStringToMask ('23041997', '||/||/||||', '|');
     *          output: 23/04/1997
     *
     * @param string $stringToConvert
     * @param string $maskRule
     * @param string $maskBaseChar
     * @return string
     */
    public static function changeStringToMask
        (string $stringToConvert, string $maskRule, string $maskBaseChar = '#') : string {

        $maskLenght = strlen($maskRule);
        $baseStringPointer = 0;

        for ($i=0;$i<$maskLenght;$i++) {

            if ($maskRule [$i] == $maskBaseChar && isset ($stringToConvert[$baseStringPointer])) {

                $maskRule [$i] = $stringToConvert[$baseStringPointer++];

            }

        }

        return $maskRule;

    }


    /**
     * Remove todos os caracteres não numéricos de uma string.
     *
     * @param string $stringToRemove
     * @return string
     */
    public static function removeAllNotNumeric(string $stringToRemove) : string {

        return preg_replace("/[^0-9]+/", "", $stringToRemove);

    }

    /**
     * Retorna a string inserida removendo qualquer caracter numérico.
     *
     * @param string $stringToRemove
     * @return string
     */
    public static function removeNumbers(string $stringToRemove) : string {

        return preg_replace("/\D/", "", $stringToRemove);

    }

    /**
     * Remove da string qualquer caracter que seja uma letra.
     *
     * @param $stringToRemove
     * @return null|string|string[]
     */
    public static function removeLetters($stringToRemove) {

        return preg_replace("/[A-Za-z]/", "", $stringToRemove);

    }

    /**
     * Decodifica uma string UTF8 para ISO-8859-1
     *
     * @param string $stringToDecode
     * @return string
     */
    public static function utf8Decode (string $stringToDecode) : string {

        return utf8_decode($stringToDecode);

    }

    /**
     * Codifica uma string ISO-8859-1 para UTF8.
     *
     * @param string $stringToEncode
     * @return string
     */
    public static function utf8Encode (string $stringToEncode) : string {

        return utf8_encode($stringToEncode);

    }

    /**
     * Tranforma um determinado texto no formato usado por javascript.
     *
     * @param string $stringToConvert
     * @return string
     */
    public static function javascriptEntities(string $stringToConvert) : string {

        return str_replace(self::allUFT8Chars(), self::javascriptEntitiesCharsArray(), $stringToConvert);

    }

    /**
     * Reverte uma string no formato usado por javascript para o padrão do PHP.
     *
     * @param string $stringToConvert
     * @return string
     */
    public static function revertjavascriptEntities (string $stringToConvert) : string {

        return str_replace(self::javascriptEntitiesCharsArray(), self::allUFT8Chars(), $stringToConvert);

    }

    /**
     * @return array
     */
    private static function javascriptEntitiesCharsArray () : array {

        return
            [
                '\u00e1','\u00e0','\u00e2','\u00e3','\u00e4', '\u00c1','\u00c0','\u00c2','\u00c3','\u00c4', '\u00e9',
                '\u00e8','\u00ea','\u00c9','\u00c8', '\u00ca','\u00cb','\u00ed','\u00ec','\u00ee', '\u00ef','\u00cd',
                '\u00cc','\u00ce','\u00cf', '\u00f3','\u00f2','\u00f4','\u00f5','\u00f6', '\u00d3','\u00d2','\u00d4',
                '\u00d5','\u00d6', '\u00fa','\u00f9','\u00fb','\u00fc','\u00da', '\u00d9','\u00db','\u00e7','\u00c7',
                '\u00f1', '\u00d1','\u0026','\u0027'
            ];

    }

    /**
     * @return array
     */
    private static function allUFT8Chars () : array {

        return
            [
                'á','à','â','ã','ä','Á','À','Â', 'Ã','Ä','é','è','ê','É','È','Ê', 'Ë','í','ì','î','ï','Í','Ì','Î', 'Ï',
                'ó','ò','ô','õ','ö','Ó','Ò', 'Ô','Õ','Ö','ú','ù','û','ü','Ú', 'Ù','Û','ç','Ç','ñ','Ñ','&',"="
            ];

    }

    /**
     * Retorna um texto html não usável pelo navegador.
     *
     * @param string $stringToConvert
     * @return string
     */
    public static function htmlEntities (string $stringToConvert) :string {

        return htmlentities($stringToConvert);

    }

    /**
     * Remove todos os arcentos de uma determinada string.
     * 
     * @param string $string
     * @return string
     */
    public static function removeAccents(string $string) : string  {

        return str_replace
        (
            [
                "á", "à", "â", "ã", "ä", "é", "è", "ê", "ë", "í", "ì", "î", "ï", "ó", "ò", "ô", "õ", "ö", "ú", "ù",
                "û", "ü", "ç", "Á", "À", "Â", "Ã", "Ä", "É", "È", "Ê", "Ë", "Í", "Ì", "Î", "Ï", "Ó", "Ò", "Ô", "Õ", "Ö",
                "Ú", "Ù", "Û", "Ü", "Ç"
            ],
            [
                "a", "a", "a", "a", "a", "e", "e", "e", "e", "i", "i", "i", "i", "o", "o", "o", "o", "o", "u", "u",
                "u", "u", "c", "A", "A", "A", "A", "A", "E", "E", "E", "E", "I", "I", "I", "I", "O", "O", "O", "O", "O",
                "U", "U", "U", "U", "C"
            ],
            $string
        );

    }

    /**
     * Retorna posição que um termo aparece em uma string
     *
     * @param string $term
     * @param string $string
     * @return mixed
     */
    public static function getTermPos (string $term, string $string) {

        return strpos($string, $term);

    }

    public static function urlDecodeArray ($terms) {


        foreach ($terms as $key => $term) {

            $terms[$key] = self::urlDecode($term);

        }

        return $terms;

    }

    public static function urlDecode (string $term) {

        return urldecode($term);

    }

}