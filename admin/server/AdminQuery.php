<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-07
 * Time: 2:18 AM
 */
require_once 'Utility.php';
require_once '../Db.php';
include 'server/entity/Admin.php';

class AdminQuery
{
    function insertAdmin($username, $email, $password) {
        $db = Db::getInstance();
        $sql = "INSERT\n"
            . "INTO\n"
            . " administrator(username,\n"
            . " password,\n"
            . " email)\n"
            . "VALUES($username, $password, $email)";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    /**
     * true if returns at least one result
     * @param $admin
     * @return string
     */
    function selectAdminByUsernamePassword(&$admin){
        $new_admin = new Admin($admin->getUsername(), $admin->getPassword());
        $username = $new_admin->getUsername();
        $password = $new_admin->getPassword();


        $db = Db::getInstance();
        // this ensures both username and password combination exist
        $sql = "SELECT\n"
            . " `email` \n"
            . "FROM\n"
            . " administrator\n"
            . "WHERE\n"
            . " username = $username AND password = $password";

        $query = $db->prepare($sql);
        $query->execute();

        return !empty($query->fetchColumn(0));

    }

    /**
     * Returns the hashed password
     * from database.
     * @param $username
     * @return string
     */
    function selectAdminByUsername($username) {
        $db = Db::getInstance();
        $sql = "SELECT\n"
            . " `password`\n"
            . "FROM\n"
            . " `administrator`\n"
            . "WHERE\n"
            . " `username` = $username";
        $query = $db->prepare($sql);
        $query->execute();

        $util = new Utility();
        return $util->stringValue($query->fetchColumn(0));
    }

    function isUsernameTaken($usernameStr) {
        $exists = null;
        if(strlen(AdminQuery::selectAdminByUsername($usernameStr)) > 4 ) {
            $exists = "true";
        } else {
            $exists = "false";
        }
        return $exists;
    }

    function redirectNotAdmin($usernameStr) {
        if(AdminQuery::isUsernameTaken($usernameStr) == "false") {
            header( "Location:not-found.php" );
        }
    }
}