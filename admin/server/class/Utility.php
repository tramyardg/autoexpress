<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-15
 * Time: 2:03 AM
 */
class Utility
{
    function stringValue($str) {
        return "'" . $str . "'";
    }

    function lastUpdateDifference($date1, $date2) {

        $last_update_date = array(
            "year"    => substr($date2, 0, 4),
            "month"   => substr($date2, -14, -12),
            "day"     => substr($date2, -11, -8),
            "hour"    => substr($date2, -8, -6),
            "min"     => substr($date2, -5, -3),
            "sec"     => substr($date2, -2)
        );

        $current_date = array(
            "year"    => substr($date1, 0, 4),
            "month"   => substr($date1, -14, -12),
            "day"     => substr($date1, -11, -8),
            "hour"    => substr($date1, -8, -6),
            "min"     => substr($date1, -5, -3),
            "sec"     => substr($date1, -2)
        );

        $sec_diff =  abs($current_date["sec"] - $last_update_date["sec"]);
        $year_diff =  abs($current_date["year"] - $last_update_date["year"]);
        $month_diff =  abs($current_date["month"] - $last_update_date["month"]);
        $day_diff =  abs($current_date["day" ] - $last_update_date["day"]);
        $hour_diff =  abs($current_date["hour"] - $last_update_date["hour"]);


    }




}