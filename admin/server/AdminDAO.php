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

    // mostly used for select queries, mapping results to a class
    function query($sql)
    {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $admin = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $admin[] = new Admin(
                $row["adminId"],
                $row["username"],
                $row["password"],
                $row["email"],
                $row["privilege"],
                $row["last_update"]
            );
        }
        $stmt = null;
        return $admin;
    }

    // used for counting the number of records

    function countAll($sql) {
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $results = array();
        while ($row = $stmt->fetchColumn(0)) {
            $results[] = $row[0];
        }
        return $results[0];
    }

    function getAllAdmin()
    {
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `administrator`";
        return $this->query($sql);
    }

    function getAdminByUsername($username)
    {
        $username_ = $this->stringValue($username);
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `administrator`\n"
            . "WHERE\n"
            . " username = $username_";

        return $this->query($sql);

    }

    /**
     * I'm only updating 2 elements here
     * tested
     */
    function update(&$admin) {
        $_password = $this->stringValue($admin->getPassword());
        $_update_time = $this->stringValue($admin->getLastUpdate());
        $sql = "UPDATE\n"
            . " `administrator`\n"
            . "SET\n"
            . " `password` = $_password,\n"
            . " `last_update` = $_update_time\n"
            . "WHERE\n"
            . " `adminId` = ".$admin->getAdminId();
        $db = Db::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // create new admin - good enough
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
        if (($this->getAdminByUsername($usernameStr))) {
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
            if ($this->isUsernameTaken($request_username) == "false") {
                header("Location:not-found.php");
            }
        }
    }


    function countAllAdmin() {
        $sql = "SELECT COUNT(*) FROM administrator";
        return $this->countAll($sql);
    }


}