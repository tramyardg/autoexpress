<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-07
 * Time: 10:11 PM
 */
//require_once '../../../Db.php';
class Admin2
{
    private $_admin_id;
    private $_username;
    private $_password;
    private $_email;
    private $_privilege;
    private $_last_update;

    /**
     * @return mixed
     */
    public function getLastUpdate()
    {
        return $this->_last_update;
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

    public function __construct(DbQueryResult $result){
        $this->_admin_id = $result->adminId;
        $this->_username = $result->username;
        $this->_password = $result->password;
        $this->_email = $result->email;
        $this->_privilege = $result->privilege;
        $this->_last_update = $result->last_update;
    }

//    public function __toString(){
//        return $this->_username;
//    }

}