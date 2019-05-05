<?php


class Dbh
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
            host=' . 'localhost' . ';
            dbname=' . 'autoexpress' . '',
                '' . 'root' . '',
                '' . '' . '',
                $pdo_options
            );
        }
        return self::$instance;
    }
}