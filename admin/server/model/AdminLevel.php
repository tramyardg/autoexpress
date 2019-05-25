<?php


class AdminLevel extends Enum
{
    // Ref: http://wiki.c2.com/?AccessControlList
    const NONE                      = 0;
    const READ_UPDATE               = 1;
    const READ_UPDATE_INSERT        = 2;
    const READ_UPDATE_INSERT_DELETE = 3;

    public static function splitAdminLevelArray($levelNumber) {
        if ($levelNumber == 0) {
            return "NONE";
        } else {
            $str = AdminLevel::toString($levelNumber);
            $strippedUnderscore = str_replace("_", " ", $str);
            return explode(" ", $strippedUnderscore);
        }
    }
}

//Usage examples:
//$monday = DayOfWeek::Monday                      // (int) 1
//DayOfWeek::isValidName('Monday')                 // (bool) true
//DayOfWeek::isValidName('monday', $strict = true) // (bool) false
//DayOfWeek::isValidValue(0)                       // (bool) true
//DayOfWeek::fromString('Monday')                  // (int) 1
//DayOfWeek::toString(DayOfWeek::Tuesday)          // (string) "Tuesday"
//DayOfWeek::toString(5)                           // (string) "Friday"