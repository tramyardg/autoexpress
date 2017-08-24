<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-07
 * Time: 10:11 PM
 */
//require_once '../../../Db.php';
class Admin
{
    private $_admin_id;
    private $_username;
    private $_password;
    private $_email;
    private $_privilege;
    private $_last_update;

    /**
     * Admin constructor.
     * @param $_admin_id
     * @param $_username
     * @param $_password
     * @param $_email
     * @param $_privilege
     * @param $_last_update
     */
    public function __construct($_admin_id, $_username, $_password, $_email, $_privilege, $_last_update)
    {
        $this->_admin_id = $_admin_id;
        $this->_username = $_username;
        $this->_password = $_password;
        $this->_email = $_email;
        $this->_privilege = $_privilege;
        $this->_last_update = $_last_update;
    }


    /**
     * @param mixed|null $admin_id
     */
    public function setAdminId($admin_id)
    {
        $this->_admin_id = $admin_id;
    }

    /**
     * @param mixed|null $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @param mixed|null $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @param mixed|null $email
     */
    public function setEmail($email)
    {
        $this->_email = $email;
    }

    /**
     * @param mixed|null $privilege
     */
    public function setPrivilege($privilege)
    {
        $this->_privilege = $privilege;
    }

    /**
     * @param mixed|null $last_update
     */
    public function setLastUpdate($last_update)
    {
        $this->_last_update = $last_update;
    }


    /**
     * @return mixed|null
     */
    public function getAdminId()
    {
        return $this->_admin_id;
    }

    /**
     * @return mixed|null
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @return mixed|null
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @return mixed|null
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @return mixed|null
     */
    public function getPrivilege()
    {
        return $this->_privilege;
    }

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->_last_update;
    }

    function __toString()
    {
        $out = "";
        $out .= 'id ' . $this->_admin_id."\n";
        $out .= 'username ' . $this->_username."\n";
        $out .= 'password ' . $this->_password."\n";
        $out .= 'email ' . $this->_email."\n";
        $out .= 'privilege ' . $this->_privilege."\n";
        $out .= 'last update ' . $this->_last_update."\n";
        return $out;
    }


//
//
//    public function __construct(DbQueryResult $result)
//    {
//        $this->_admin_id = $result->adminId;
//        $this->_username = $result->username;
//        $this->_password = $result->password;
//        $this->_email = $result->email;
//        $this->_privilege = $result->privilege;
//        $this->_last_update = $result->last_update;
//    }
}