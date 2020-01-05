<?php namespace System\Models\Tools\Basic;


class Session
{
    /**
     * Seta determinados valores na sessão.
     *
     * @param array $sessionParams
     */
    public static function set (array $sessionParams) {

        foreach ($sessionParams as $sessionKey => $sessionValue) {

            $_SESSION[$sessionKey] = $sessionValue;

        }

    }

    /**
     * @return bool
     */
    public static function hasSession () : bool {

        return !empty($_SESSION);

    }

    /**
     * @return bool
     */
    public static function noHasSession () : bool {

        return !isset($_SESSION) || empty($_SESSION);

    }

    public static function sessionDestroy () {

        session_unset();

    }

}