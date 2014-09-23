<?php

Class TimeTools {

    public static function get_time_id($theDate) {
        $get2009TimeStamp = strtotime('2009-01-01 12:00');
        $getTheDateTimeStamp = strtotime($theDate);
        // Missing scenario: if theDate is lower than 2009 
        if ($getTheDateTimeStamp < $get2009TimeStamp) {
            return 1;
        } else {
            $getSubstractDays = $getTheDateTimeStamp - $get2009TimeStamp;
            return ceil($getSubstractDays / 60 / 60 / 24) + 1;
        }
    }

    /**
     * @param int $timeid * @return int with timestamp format 
     */
    public static function get_time_by_id($timeid) {
        $timeid = intval($timeid);
        $get2009TimeStamp = strtotime('2009-01-01 12:00');
        if (!$timeid) {
            echo 'invalid time id';
        } else {
            return $get2009TimeStamp + ceil(($timeid - 1) * 60 * 60 * 24);
        }
    }

}