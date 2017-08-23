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

class DbQueryResult
{

    private $_results = array();

    public function __construct() {}

    public function __set($var, $val)
    {
        $this->_results[$var] = $val;
    }

    public function __get($var)
    {
        if (isset($this->_results[$var])) {
            return $this->_results[$var];
        } else {
            return null;
        }
    }

    // mostly used for select queries, mapping results to a class
    public function query($sql)
    {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $results = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new DbQueryResult();
            foreach ($row as $k => $v) {
                $result->$k = $v;
            }

            $results[] = $result;
        }

        $stmt = null;
        return $results;
    }

    // used for counting the number of records
    public function countAll($sql) {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $results = array();
        while ($row = $stmt->fetchColumn(0)) {
            $results[] = $row[0];
        }
        return $results[0];
    }

    public function query_void($sql) {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
