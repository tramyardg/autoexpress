<?php
ini_set('date.timezone', 'America/Toronto');

class Utility
{

    /**
     * Utility constructor.
     */
    public function __construct()
    {
    }

    function getTimeStamp()
    {
        return date('Y-m-d H:i:s', gmdate('U'));
    }

    function stringValue($str)
    {
        return "'" . $str . "'";
    }

    function incrementId($id)
    {
        return intval($id) + 1;
    }

    /**
     * $_FILES['file']['tmp_name'] is shortened to $file['tmp_name']
     * when this function is used
     * @param $file
     * @return array
     */
    function reArrayFiles($file)
    {
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

    function formatNumber($num)
    {
        $three_dec_format = number_format($num, 3);
        $pos_of_dot = strpos($three_dec_format, '.');
        $final_number = substr($three_dec_format, 0, $pos_of_dot);
        return $this->stringValue($final_number);
    }
}