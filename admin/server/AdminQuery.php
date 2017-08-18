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
    function updateAdminPass($password, $adminId, $update_time) {
        $util = new Utility();
        $_password = $util->stringValue($password);
        $_update_time = $util->stringValue($update_time);

        $sql = "UPDATE\n"
            . " `administrator`\n"
            . "SET\n"
            . " `password` = $_password,\n"
            . " `last_update` = $_update_time\n"
            . "WHERE\n"
            . " `adminId` = $adminId";

        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    function insertAdmin($username, $email, $password)
    {
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

    function selectAllAdminInfo_byUsername($username)
    {
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

    function selectAllAdmin()
    {
        $db = new DbQueryResult();
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `administrator`";

        return $db->query($sql);
    }


    // reuse existing sql
    function isUsernameTaken($usernameStr)
    {
        $exists = null;
        if ((AdminQuery::selectAllAdminInfo_byUsername($usernameStr))) {
            $exists = "true";
        } else {
            $exists = "false";
        }
        return $exists;
    }

    function notFoundLocation($usernameStr)
    {
        if (AdminQuery::isUsernameTaken($usernameStr) == "false") {
            header("Location:not-found.php");
        }
    }

    function redirectNotFoundAdmin($request_username)
    {
        if (!empty($request_username)) {
            AdminQuery::notFoundLocation($request_username);
        }
    }

    function adminData_byUsername($session_username)
    {
        $results = AdminQuery::selectAllAdminInfo_byUsername($session_username);
        $admin_obj = array();
        if (!$results) {
            return $results;
        } else {
            foreach ($results as $result) {
                $admin_obj[] = new Admin2($result);
            }
        }
        return $admin_obj;
    }

    function allAdminData()
    {
        $results = AdminQuery::selectAllAdmin();
        $admin_obj = array();
        if (!$results) {
            return $results;
        } else {
            foreach ($results as $result) {
                $admin_obj[] = new Admin2($result);
            }
        }
        return $admin_obj;
    }


}