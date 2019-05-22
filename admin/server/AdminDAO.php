<?php

require_once 'model/Utility.php';
require_once 'model/Dbh.php';
require_once 'model/Admin.php';

class AdminDAO extends Utility
{

    // mostly used for select queries, mapping results to a model
    function query($sql)
    {
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $admin = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $admin[] = new Admin(
                $row["adminId"],
                $row["username"],
                $row["password"],
                $row["email"],
                $row["admin_level"],
                $row["last_update"]
            );
        }
        $stmt = null;
        return $admin;
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
    function update(&$admin)
    {
        $_password = $this->stringValue($admin->getPassword());
        $_update_time = $this->stringValue($admin->getLastUpdate());
        $sql = "UPDATE\n"
            . " `administrator`\n"
            . "SET\n"
            . " `password` = $_password,\n"
            . " `last_update` = $_update_time\n"
            . "WHERE\n"
            . " `adminId` = " . $admin->getAdminId();
        $db = Dbh::getInstance();
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

        $sql = "INSERT\n"
            . "INTO\n"
            . " administrator(username,\n"
            . " password,\n"
            . " email)\n"
            . "VALUES($_username, $_password, $_email)";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // redirect 404 if users trying to access a non-existing admin
    function redirectNotFoundAdmin($request_username)
    {
        if (!empty($request_username)) {
            if (count($this->getAdminByUsername($request_username)) > 0) {
                header("Location:not-found.php");
            }
        }
    }

}