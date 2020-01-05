<?php namespace System\Models\Tools\Basic;
/**
 * Class DateTimeTools
 *
 * Classe responsável por fazer algumas das funções mais comuns de tratamento de data/hora
 * para as funções do sistema.
 */
/**
 * Class DateTimeTools
 * @package System\Models\Tools\Basic
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

        return sprintf ('%02d:%02d:%02d', $seconds/3600, ($seconds%3600)/60, ($seconds%3600)%60);

    }

    /**
     * @param string $hours
     * @param string $delimiter
     * @return float|int
     */
    public static function convertHoursToSeconds (string $hours, string $delimiter = ':') : int {

        $hours = explode($delimiter, $hours);
        return $hours['2'] + $hours['1'] * 60 + $hours['0'] * 3600;

    }

    public static function getDiffBetweenHours ($starterHour, $endHour) {

        return self::secondsToHours(
            self::convertHoursToSeconds($starterHour) - self::convertHoursToSeconds($endHour)
        );

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
     * @return string
     */
    public static function convertDateFormat (string $dateToConvert, string $dateFormat) : string {

        return date ($dateFormat, strtotime($dateToConvert));

    }

    /**
     * @param string $date
     * @param string $changeTime
     * @param bool $getTimestamp
     * @param string $dateFormat
     * @return false|int|string
     */
    public static function getDateTimeStampOrDate(
        string $date,
        string $changeTime = '+ 0 days',
        bool $getTimestamp = true,
        $dateFormat = 'Y-m-d H:i:s') {

        $dateTimestamp = strtotime ($date.' '.$changeTime);

        return $getTimestamp
            ? $dateTimestamp
            : self::timestampToDateConvert($dateTimestamp, $dateFormat);

    }

    /**
     * @param string $timestamp
     * @param string $dateFormat
     * @return string
     */
    public static function timestampToDateConvert (string $timestamp, string $dateFormat) : string {

        return date ($dateFormat, $timestamp);

    }

}