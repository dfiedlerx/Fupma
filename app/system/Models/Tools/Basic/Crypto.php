<?php namespace System\Models\Tools\Basic;
/*
*Classe com o intuito de gerar as criptografias do sistema. 
*Também fará comparações de criptografia.
*/

/**
 * Class Crypto
 * @package System\Models\Tools\Basic
 * @author Daniel Fiedler
 */
class Crypto
{

    /**
     * Função que irá gerar uma chave aleatória para senhas de usuários.
     * Utiliza-se um Md5 sobre o tempo em milesegundos concatenado com um random de 100000 a 999999
     *
     * @return string
     */
	public static function hashKeyGenerator (){

        $baseHash =
            '0123456789abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ./'
            .str_replace (' ', mt_rand (0, 9),microtime())
            .rand(1000000,9999999);

        $key = '';

        for ($i=0; $i<102; $i++) {

            $key .= $baseHash[mt_rand (0,101)];

        }

		return $key;

	}

    /**
     * Função publica que ira gerar a senha criptografada.
     * Padrão usado: Bcrypt;
     *
     * @param string $contentToConvert
     * @return string
     */
	public static function passwordHashGenerator (string $contentToConvert) :string {

		return
            StringC::subsStrTerm(
                crypt
                (
                    $contentToConvert,
                    DEFAULT_CRYPTO_CICLE.self::hashKeyGenerator().'$'
                ),
                DEFAULT_CRYPTO_CICLE,
                ''
            );

	}


    /**
     * Função publica que ira gerar uma chave própria para cada sistema
     * Padrão usado: MD5;
     *
     * @return string
     */
	public static function systemHashGenerator () :string {

		return
            md5(Filter::externalFilter(

                4,
                'HTTP_USER_AGENT').Filter::externalFilter(

                    4,
                    'REMOTE_ADDR'

                )

            );

	}

    /**
     * Função publica que ira comparar a senha informada com a senha no banco
     * Padrão usado: Bcrypt;
     *
     * @param string $targetString
     * @param string $hashKey
     * @return bool
     */
	public static function hashComparer (string $targetString, string $hashKey) :bool {

	        $mergedCrypto = DEFAULT_CRYPTO_CICLE . $hashKey;
            return crypt($targetString, $mergedCrypto) == $mergedCrypto;

	}


}