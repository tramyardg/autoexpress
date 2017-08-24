<?php
require_once(dirname(__FILE__) . '/conf/config.php');

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
            self::$instance = new PDO('mysql:
            host=' . DB_HOST . ';
            dbname=' . DB_DB_NAME . '',
                '' . DB_USER . '',
                '' . DB_PASSWORD . '',
                $pdo_options
            );
        }
        return self::$instance;
    }
}