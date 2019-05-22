<?php

class Admin
{
    private $adminId;
    private $username;
    private $password;
    private $email;
    private $admin_level;
    private $last_update;

    public function __construct($admin_id, $username, $password, $email, $admin_level, $last_update)
    {
        $this->adminId = $admin_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->admin_level = $admin_level;
        $this->last_update = $last_update;
    }

    public function setAdminId($admin_id)
    {
        $this->adminId = $admin_id;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setAdminLevel($admin_level)
    {
        $this->admin_level = $admin_level;
    }

    public function setLastUpdate($last_update)
    {
        $this->last_update = $last_update;
    }

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAdminLevel()
    {
        return $this->admin_level;
    }

    public function getLastUpdate()
    {
        return $this->last_update;
    }

    function __toString()
    {
        $out = "";
        $out .= 'id ' . $this->adminId . "\n";
        $out .= 'username ' . $this->username . "\n";
        $out .= 'password ' . $this->password . "\n";
        $out .= 'email ' . $this->email . "\n";
        $out .= 'admin_level ' . $this->admin_level . "\n";
        $out .= 'last update ' . $this->last_update . "\n";
        return $out;
    }

}