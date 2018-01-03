<?php namespace ModelTools;
/**
 * Fupma
 *
 * Classe responsável por validar conteudos de variaveis que tem valores
 * vindos de dentro do proprio sistema.
 *
 * Também é ultil para verificar se determinado conteudo é do tipo desejado
 */


class VarContentValidator
{

    //Método que apenas filtra uma variavel com um filtro fixo ou personalizado
    public static function internalFilter (string $stringToFilter, int $typeOfFilter = FILTER_SANITIZE_STRING) :boll {

        return filter_var ($stringToFilter, $typeOfFilter);

    }

    //Método responsável por retornar se determinado conteudo e do tipo email
    public static function isAValidEmail (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_EMAIL);

    }

    //Verifica se o conteudo e do tipo inteiro
    public static function isAValidInt (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_INT);

    }

    //Verifica se o conteudo é uma url
    public static function isAValidURL (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_URL);

    }

    //Verifica se o conteudo é um endereço IP
    public static function isAValidIPAddress (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_IP);

    }

    //Verifica se o conteúdo é do tipo max
    public static function isAValidMacAddress (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_MAC);

    }

    //Verifica se o conteudo e um dominio
    public static function isAValidDomain (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_DOMAIN);

    }

    //Verifica se o conteudo e do tipo boolean
    public static function isAValidBoolean (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_BOOLEAN);

    }

    //Veirifica se o conteudo e do tipo Float
    public static function isAValidFloat (string $contentToValidate) :boll {

        return filter_var ($contentToValidate, FILTER_VALIDATE_FLOAT);

    }

    //Verifica se o conteudo é um Regex válido
    public static function isAValidRegexExp (string $contentToValidate) :bool {

        return filter_var ($contentToValidate, FILTER_VALIDATE_REGEXP);

    }

    //Verifica se o conteudo é exatamente do tamanho especificado
    public static function isACorrectStringLenght (string $contentToValidate, int $stringLenght) :bool {

        return strlen ($contentToValidate) == $stringLenght;

    }



}