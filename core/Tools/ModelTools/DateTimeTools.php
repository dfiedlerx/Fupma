<?php namespace Tools\ModelTools;
/**
 * Class DateTimeTools
 *
 * Classe responsável por fazer algumas das funções mais comuns de tratamento de data/hora
 * para as funções do sistema.
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
            str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' .
            str_pad(floor(($seconds - ($hours * 3600)) / 60), 2, '0', STR_PAD_LEFT) . ':' .
            str_pad( floor($seconds % 60), 2, '0', STR_PAD_LEFT);

    }

    public function getIntervalBetweenDatesInSeconds (string $smallerDate, string $greaterDate) : int {

        return strtotime($smallerDate) - strtotime($greaterDate);

    }


}