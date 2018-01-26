<?php namespace Tools\ModelTools;




class StringTools
{

    /**
     * @param string $suspect
     * @param int $quantity
     * @return int
     */
    public static function isTheStrLenght (string $suspect, int $quantity) : int {

        return strlen ($suspect) == $quantity;

    }

    /**
     * @param string $indictee
     * @param $tax
     * @param $payBack
     * @return string
     */
    public static function subsStrTerm (string $indictee, $tax, $payBack) : string {

        return str_replace ($tax, $payBack, $indictee);

    }

    /**
     * @param $suspect
     * @param $search
     * @return bool
     */
    public static function existsStrTerm ($suspect, $search) :bool {

        return preg_match ('/'.$search.'/', $suspect);

    }



}