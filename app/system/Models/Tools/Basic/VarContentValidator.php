<?php namespace System\Models\Tools\Basic;
/**
 * Fupma
 *
 * Classe responsável por validar conteudos de variaveis que tem valores
 * vindos de dentro do proprio sistema.
 *
 * Também é ultil para verificar se determinado conteudo é do tipo desejado
 */

/**
 * Class VarContentValidator
 * @package System\Models\Tools\Basic
 * @author Daniel Fiedler
 */
class VarContentValidator
{

    /**
     * Método responsável por retornar se determinado conteudo e do tipo email.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidEmail (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_EMAIL);

    }

    /**
     * Verifica se o conteudo e do tipo inteiro.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidInt (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_INT);

    }

    /**
     * Verifica se o conteudo é uma url.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidURL (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_URL);

    }

    /**
     * Verifica se o conteudo é um endereço IP.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidIPAddress (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_IP);

    }

    /**
     * Verifica se o conteúdo é do tipo max.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidMacAddress (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_MAC);

    }
    
    /**
     * Verifica se o conteudo e um dominio.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidDomain (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_DOMAIN);

    }

    /**
     * Verifica se o conteudo e do tipo boolean.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidBoolean (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_BOOLEAN);

    }

    

    /**
     * Veirifica se o conteudo e do tipo Float.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidFloat (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_FLOAT);

    }

    /**
     * Verifica se o conteudo é um Regex válido.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAValidRegexExp (string $suspect) : bool {

        return filter_var ($suspect, FILTER_VALIDATE_REGEXP);

    }

    /**
     * Verifica se o conteudo é exatamente do tamanho especificado.
     *
     * @param string $contentToValidate
     * @param int $stringLenght
     * @return bool
     */
    public static function isACorrectStringLenght (string $contentToValidate, int $stringLenght) : bool {

        return strlen ($contentToValidate) == $stringLenght;

    }

    /**
     * Verifica se determinada string é um json.
     *
     * @param string $suspect
     * @return bool
     */
    public static function isAJson (string $suspect) : bool {

        json_decode($suspect);
        return (json_last_error() == JSON_ERROR_NONE);

    }

    /**
     * Verifica se variável é um array.
     *
     * @param $suspect
     * @return bool
     */
    public static function isAArray ($suspect) : bool {

        return is_array($suspect);

    }

}