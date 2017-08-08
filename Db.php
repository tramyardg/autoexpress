<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-06
 * Time: 8:02 PM
 */
class Db
{
    private static $instance = NULL;

    private function __construct()
    {

    }

    private function __close()
    {

    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO('mysql:host=localhost;dbname=test', 'root', '', $pdo_options);
        }
        return self::$instance;
    }
}