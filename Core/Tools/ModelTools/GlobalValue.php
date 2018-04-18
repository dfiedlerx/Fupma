<?php
/**
 * Created by PhpStorm.
 * User: Desenvolvimento
 * Date: 18/04/2018
 * Time: 14:00
 */

namespace Core\Tools\ModelTools;


class GlobalValue
{

    private static $globalCase = [];

    /**
     * @param string $setName
     * @param $setValue
     * @param bool $ovewrite
     * @return bool
     */
    public static function set (string $setName, $setValue, bool $ovewrite = false) : bool {

        if ($ovewrite || !isset(self::$globalCase[$setName])) {

            self::$globalCase[$setName] = $setValue;
            return true;

        }

        return false;

    }

    /**
     * @param string $getName
     * @return mixed
     */
    public static function get (string $getName) {

        return self::$globalCase[$getName];

    }

    /**
     * @param string $globalName
     * @return bool
     */
    public static function exists (string $globalName) : bool {

        return isset(self::$globalCase[$globalName]);

    }

    /**
     * @param string $globalName
     */
    public static function remove (string $globalName) {

        unset(self::$globalCase[$globalName]);

    }

}