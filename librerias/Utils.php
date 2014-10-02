<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 28/09/14
 * Time: 17:29
 */

class Utils {

    public static function formatDateString ($dateString){

        $date = new DateTime($dateString);
        $dateFormatted = $date->format('d/m/Y');

        return $dateFormatted;

    }
    public static function formatDateAndHourString ($dateString){

        $date = new DateTime($dateString);
        $dateFormatted = $date->format('d/m/Y H:i:s');

        return $dateFormatted;

    }
}
