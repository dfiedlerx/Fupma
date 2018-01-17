<?php namespace Tools\ModelTools;
/*
* Classe destinada a manipulação de Cookies do sistema
* Cria, edita, deleta, lê, verifica existência.
* Foi usado um método que resolve o problema com o php nao reconhecer que cookies
* Foram deletados, editados ou adicionados sem recarregar a página.
*
*/

/**
 * Class Cookie
 * @package ModelTools
 */
class Cookie
{

    /**
     * Método que Verifica se o Cookie existe e nao está vazio
     *
     * @param string $cookieName
     * @return bool
     */
	public static function searchCookie(string $cookieName){

        return isset($_COOKIE[$cookieName]) && self::readCookie($cookieName) != 'DELETED';

	} 

    /**
     * Método que cria ou edita Cookies
     *
     * @param string $cookieName
     * @param $cookieContent
     * @param int $cookieExpiration
     * @param string $cookieDirectory
     * @return bool
     */
	public static function setCookie(string $cookieName, $cookieContent, int $cookieExpiration = DEFAULT_COOKIE_EXPIRATION, string $cookieDirectory = '/'){

		$_COOKIE [$cookieName] = $cookieContent; 
		return setcookie ($cookieName, $cookieContent, $cookieExpiration, $cookieDirectory);

	}


    /**
     * Método que lê Cookies
     *
     * @param string $cookieName
     * @return mixed|null
     */
	public static function readCookie (string $cookieName){

		return 
			isset ($_COOKIE[$cookieName]) && !is_null ($_COOKIE[$cookieName]) ? Filter::internalFilter($_COOKIE[$cookieName]) : null;

	}


    /**
     * Método que Deleta Cookies
     *
     * @param string $cookieName
     * @param string $cookieDirectory
     * @return bool
     */
 	public static function deleteCookie (string $cookieName, string $cookieDirectory = '/'){

 		unset ($_COOKIE [$cookieName]); return setcookie($cookieName, 'DELETED', 1, $cookieDirectory);

 	}

}