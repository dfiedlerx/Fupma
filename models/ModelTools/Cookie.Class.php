<?php namespace ModelTools;
/*
* Classe destinada a manipulação de Cookies do sistema
* Cria, edita, deleta, lê, verifica existência.
* Foi usado um método que resolve o problema com o php nao reconhecer que cookies
* Foram deletados, editados ou adicionados sem recarregar a página.
*
*/

class Cookie
{

 	/*
 	* Método que Verifica se o Cookie existe e nao está vazio
 	*/

	public static function searchCookie(string $cookieName){

        return isset($_COOKIE[$cookieName]);

	} 


 	/*
 	* Método que cria ou edita Cookies
 	*/

	public static function setCookie(string $cookieName, $cookieContent, int $cookieExpiration = DEFAULT_COOKIE_EXPIRATION, string $cookieDirectory = '/'){

		$_COOKIE [$cookieName] = $cookieContent; 
		return setcookie($cookieName, $cookieContent, $cookieExpiration, $cookieDirectory);

	}


 	/*
 	* Método que lê Cookies
 	*/

	public static function readCookie (string $cookieName){

		return 
			isset ($_COOKIE[$cookieName]) && !is_null ($_COOKIE[$cookieName]) ? $_COOKIE[$cookieName] : null;

	}


	/*
 	* Método que Deleta Cookies
 	*/

 	public static function deleteCookie (string $cookieName, string $cookieDirectory = '/'){

 		unset ($_COOKIE [$cookieName]); return setcookie($cookieName, 'DELETED', 1, $cookieDirectory);

 	}

}