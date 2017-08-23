<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-07
 * Time: 2:18 AM
 */
require_once 'class/Utility.php';
require_once '../Db.php';
require_once 'class/Admin.php';

class AdminDAO extends Utility
{

    function getAllAdmin()
    {
        $db = new DbQueryResult();
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `administrator`";

        return $db->query($sql);
    }

    function getAdminByUsername($username)
    {
        $username_ = $this->stringValue($username);
        $db = new DbQueryResult();
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `administrator`\n"
            . "WHERE\n"
            . " username = $username_";

        return $db->query($sql);

    }

    /**
     * You can only update 2 elements password, and
     * last update date.
     * @param $password
     * @param $adminId
     * @param $update_time
     * @return int
     */
    function update($password, $adminId, $update_time) {
        $_password = $this->stringValue($password);
        $_update_time = $this->stringValue($update_time);

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

    // create new admin
    function create($username, $email, $password)
    {
        $_username = $this->stringValue($username);
        $_email = $this->stringValue($email);
        $_password = $this->stringValue($password);

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

    // for registration if username is taken {boolean}
    function isUsernameTaken($usernameStr)
    {
        $exists = null;
        if ((AdminDAO::getAdminByUsername($usernameStr))) {
            $exists = "true";
        } else {
            $exists = "false";
        }
        return $exists;
    }

    // redirect 404 if users trying to access a non-existing admin
    function redirectNotFoundAdmin($request_username)
    {
        if (!empty($request_username)) {
            if (AdminDAO::isUsernameTaken($request_username) == "false") {
                header("Location:not-found.php");
            }
        }
    }

    // admin data specific to username
    function adminDataByUsername($session_username)
    {
        $results = AdminDAO::getAdminByUsername($session_username);
        $admin_obj = array();
        if (!$results) {
            return $results;
        } else {
            foreach ($results as $result) {
                $admin_obj[] = new Admin($result);
            }
        }
        return $admin_obj;
    }

    // get all admin from the database and map it
    function adminData()
    {
        $results = AdminDAO::getAllAdmin();
        $admin_obj = array();
        if (!$results) {
            return $results;
        } else {
            foreach ($results as $result) {
                $admin_obj[] = new Admin($result);
            }
        }
        return $admin_obj;
    }

    function countAllAdmin() {
        $db = new DbQueryResult();
        $sql = "SELECT COUNT(*) FROM administrator";
        return $db->countAll($sql);
    }


}