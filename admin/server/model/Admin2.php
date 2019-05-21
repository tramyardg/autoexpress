<?php

class Admin2
{
    private $adminId;
    private $username;
    private $password;
    private $email;
    private $admin_level;
    private $last_update;

    public function getAdminId()
    {
        return $this->adminId;
    }

    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getAdminLevel()
    {
        return $this->admin_level;
    }

    public function setAdminLevel($admin_level)
    {
        $this->admin_level = $admin_level;
    }

    public function getLastUpdate()
    {
        return $this->last_update;
    }

    public function setLastUpdate($last_update)
    {
        $this->last_update = $last_update;
    }

//adminId     INT                                 NOT NULL AUTO_INCREMENT,
//username    VARCHAR(10)                         NOT NULL,
//password    VARCHAR(100)                        NOT NULL,
//email       VARCHAR(30)                         NOT NULL,
//admin_level ENUM ('0', '1', '2', '3')           NOT NULL,
//last_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP NULL,

}