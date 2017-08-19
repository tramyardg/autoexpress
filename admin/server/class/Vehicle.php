<?php

/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-18
 * Time: 8:04 PM
 */
class Vehicle
{

    /**
     * @return mixed
     */
    public function getVehicleId()
    {
        return $this->_vehicleId;
    }

    /**
     * @param mixed $vehicle_id
     */
    public function setVehicleId($vehicle_id)
    {
        $this->_vehicleId = $vehicle_id;
    }

    /**
     * @return mixed
     */
    public function getMake()
    {
        return $this->_make;
    }

    /**
     * @param mixed $make
     */
    public function setMake($make)
    {
        $this->_make = $make;
    }

    /**
     * @return mixed
     */
    public function getYearMade()
    {
        return $this->_yearMade;
    }

    /**
     * @param mixed $year
     */
    public function setYearMade($year)
    {
        $this->_yearMade = $year;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->_model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->_model = $model;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->_price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->_price = $price;
    }

    /**
     * @return mixed
     */
    public function getMileage()
    {
        return $this->_mileage;
    }

    /**
     * @param mixed $mileage
     */
    public function setMileage($mileage)
    {
        $this->_mileage = $mileage;
    }

    /**
     * @return mixed
     */
    public function getTransmission()
    {
        return $this->_transmission;
    }

    /**
     * @param mixed $transmission
     */
    public function setTransmission($transmission)
    {
        $this->_transmission = $transmission;
    }

    /**
     * @return mixed
     */
    public function getDrivetrain()
    {
        return $this->_drivetrain;
    }

    /**
     * @param mixed $drivetrain
     */
    public function setDrivetrain($drivetrain)
    {
        $this->_drivetrain = $drivetrain;
    }

    /**
     * @return mixed
     */
    public function getEngineCapacity()
    {
        return $this->_engineCapacity;
    }

    /**
     * @param mixed $engine_capacity
     */
    public function setEngineCapacity($engine_capacity)
    {
        $this->_engineCapacity = $engine_capacity;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->_category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category)
    {
        $this->_category = $category;
    }

    /**
     * @return mixed
     */
    public function getCylinder()
    {
        return $this->_cylinder;
    }

    /**
     * @param mixed $cylinder
     */
    public function setCylinder($cylinder)
    {
        $this->_cylinder = $cylinder;
    }

    /**
     * @return mixed
     */
    public function getDoors()
    {
        return $this->_doors;
    }

    /**
     * @param mixed $num_doors
     */
    public function setDoors($num_doors)
    {
        $this->_doors = $num_doors;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->_status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->_status = $status;
    }

    /**
     * @return mixed
     */
    public function getDateAdded()
    {
        return $this->_dateAdded;
    }

    /**
     * @param mixed $dateAdded
     */
    public function setDateAdded($dateAdded)
    {
        $this->_dateAdded = $dateAdded;
    }

    public function carGeneralInfo() {
        return $this->_yearMade . ' ' . $this->_make . ' ' . $this->_model;
    }

    public function __construct(DbQueryResult $result){
       $this->_vehicleId = $result->vehicleId;
       $this->_make = $result->make;
       $this->_yearMade = $result->yearMade;
       $this->_model = $result->model;
       $this->_price = $result->price;
       $this->_mileage = $result->mileage;
       $this->_transmission = $result->transmission;
       $this->_drivetrain = $result->drivetrain;
       $this->_engineCapacity = $result->engineCapacity;
       $this->_category = $result->category;
       $this->_cylinder = $result->cylinder;
       $this->_doors = $result->doors;
       $this->_status = $result->status;
    }

    private $_vehicleId;
    private $_make;
    private $_yearMade;
    private $_model;
    private $_price;
    private $_mileage;
    private $_transmission;
    private $_drivetrain;
    private $_engineCapacity;
    private $_category;
    private $_cylinder;
    private $_doors;
    private $_status;
    private $_dateAdded;


}