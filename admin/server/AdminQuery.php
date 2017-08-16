<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-07
 * Time: 2:18 AM
 */
require_once 'class/Utility.php';
require_once '../Db.php';
require_once 'class/Admin2.php';

class AdminQuery
{
    function insertAdmin($username, $email, $password) {
        $util = new Utility();
        $_username = $util->stringValue($username);
        $_email = $util->stringValue($email);
        $_password = $util->stringValue($password);

        $db = Db::getInstance();
        $sql = "INSERT\n"
            . "INTO\n"
            . " administrator(username,\n"
            . " password,\n"
            . " email)\n"
            . "VALUES($_username, $_password, $_email)";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function selectAllAdminInfo($username) {
        $util = new Utility();
        $username_ = $util->stringValue($username);

        $db = new DbQueryResult();

        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `administrator`\n"
            . "WHERE\n"
            . " username = $username_";

        return $db->query($sql);

    }


    // reuse existing sql
    function isUsernameTaken($usernameStr) {
        $exists = null;
        if((AdminQuery::selectAllAdminInfo($usernameStr))) {
            $exists = "true";
        } else {
            $exists = "false";
        }
        return $exists;
    }

    function redirectNotFound($usernameStr) {
        if(AdminQuery::isUsernameTaken($usernameStr) == "false") {
            header( "Location:not-found.php" );
        }
    }
}