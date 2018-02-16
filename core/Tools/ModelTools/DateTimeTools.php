<?php namespace Tools\ModelTools;
/**
 * Class DateTimeTools
 *
 * Classe responsável por fazer algumas das funções mais comuns de tratamento de data/hora
 * para as funções do sistema.
 */
/**
 * Class DateTimeTools
 * @package Tools\ModelTools
 * @author Daniel Fiedler
 */
class DateTimeTools
{

    /**
     * @param string $dateToAcress
     * @param string $timeToAcress
     * @return string
     */
    public static function dateAcress (string $dateToAcress, string $timeToAcress) : string {

        return date ($dateToAcress, strtotime($timeToAcress));

    }

    /**
     * @param int $seconds
     * @return string
     */
    public static function secondsToHours (int $seconds) : string {

        $hours = floor($seconds / 3600);

        return
            sprintf ('%02d:%02d:%02d', $hours, ($seconds - ($hours * 3600)) / 60,  floor($seconds % 60));

    }

    /**
     * @param string $smallerDate
     * @param string $greaterDate
     * @return int
     */
    public static function getIntervalBetweenDatesInSeconds (string $smallerDate, string $greaterDate) : int {

        return strtotime($greaterDate) - strtotime($smallerDate);

    }

    /**
     * @param string $format
     * @return string
     */
    public static function getNowTime (string $format = 'Y-m-d H:i:s') : string {

        return date ($format);

    }

    /**
     * @param string $dateToConvert
     * @param string $dateFormat
     * @param string $timeChange * Ex: -3 days
     * @return string
     */
    public static function convertDateFormat (string $dateToConvert, string $dateFormat) : string {

        return date ($dateFormat, strtotime($dateToConvert));

    }


}