<?php
ini_set('date.timezone', 'America/Toronto');
/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-15
 * Time: 2:03 AM
 */
class Utility
{
    function getTimeStamp() {
        return date('Y-m-d H:i:s', gmdate('U'));
    }

    function stringValue($str) {
        return "'" . $str . "'";
    }

    function incrementId($id) {
        return intval($id) + 1;
    }

    /**
     * $_FILES['file']['tmp_name'] is shortened to $file['tmp_name']
     * when this function is used
     * @param $file
     * @return array
     */
    function reArrayFiles($file) {
        $file_array = array();
        $file_count = count($file['name']);
        $file_key = array_keys($file);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_key as $val) {
                $file_array[$i][$val] = $file[$val][$i];
            }
        }
        return $file_array;
    }


    // format number with comma given length
    function formatNumber($num) {
        $numStr = (string)$num;
        $numArr = str_split($numStr);
        $numArrLen = count($numArr);
        if($numArrLen === 4) { // 1,234
            array_splice($numArr, 1, 0, ",");
            return join('', $numArr);
        } else if($numArrLen === 5) { // 12,345
            array_splice($numArr, 2, 0, ",");
            return join('', $numArr);
        } else if($numArrLen === 6) { // 123,456
            array_splice($numArr, 3, 0, ",");
            return join('', $numArr);
        } else if($numArrLen === 7) { // 1,234,567
            array_splice($numArr, 1, 0, ",");
            array_splice($numArr, 5, 0, ",");
            return join('', $numArr);
        } else {
            return $numStr;
        }
    }




}