<?php

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

    public function setAdminId($admin_id)
    {
        $this->_admin_id = $admin_id;
    }

    public function setUsername($username)
    {
        $this->_username = $username;
    }

    public function setPassword($password)
    {
        $this->_password = $password;
    }

    public function setEmail($email)
    {
        $this->_email = $email;
    }

    public function setPrivilege($privilege)
    {
        $this->_privilege = $privilege;
    }

    public function setLastUpdate($last_update)
    {
        $this->_last_update = $last_update;
    }

    public function getAdminId()
    {
        return $this->_admin_id;
    }

    public function getUsername()
    {
        return $this->_username;
    }

    public function getPassword()
    {
        return $this->_password;
    }

    public function getEmail()
    {
        return $this->_email;
    }

    public function getPrivilege()
    {
        return $this->_privilege;
    }

    public function getLastUpdate()
    {
        return $this->_last_update;
    }

    function __toString()
    {
        $out = "";
        $out .= 'id ' . $this->_admin_id . "\n";
        $out .= 'username ' . $this->_username . "\n";
        $out .= 'password ' . $this->_password . "\n";
        $out .= 'email ' . $this->_email . "\n";
        $out .= 'privilege ' . $this->_privilege . "\n";
        $out .= 'last update ' . $this->_last_update . "\n";
        return $out;
    }

}