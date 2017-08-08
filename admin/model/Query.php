<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-07
 * Time: 2:18 AM
 */
require_once '../Db.php';
include 'model/entity/Admin.php';

class Query
{
    function insertAdmin($username, $email, $password) {
        $db = Db::getInstance();
        $sql = "INSERT\n"
            . "INTO\n"
            . " administrator(username,\n"
            . " password,\n"
            . " email)\n"
            . "VALUES($username, $password, $email)";
        echo $sql;
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    /**
     * true if returns at least one result
     * @param $admin
     * @return string
     */
    function selectIfAdminExists(&$admin){
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
        return Query::stringValue($query->fetchColumn(0));
    }

    function stringValue($str) {
        return "'" . $str . "'";
    }

    function hashedPassword($pass) {
        $options = [
            'cost' => 12 // the default cost is 10
        ];
        return Query::stringValue(password_hash($pass, PASSWORD_BCRYPT, $options));
    }

//    function isEmailMatchPassword($email, $pass) {
//        $cond = 0;
//        $fu_user = CommonUtil::fitnessUserData($email);
//        $fp_user = CommonUtil::fitnessProviderData($email);
//
//        foreach ($fp_user as $fp) {
//            if ($email === $fp->email && password_verify($pass, $fp->password)) {
//                $cond = 1;
//                break;
//            }
//        }
//
//        return $cond;
//    }

}