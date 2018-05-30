<?php

/**
 * Class Vehicle
 * implements json serializable so that
 * it can be encoded in json
 */
require_once 'Utility.php';
class Vehicle implements JsonSerializable
{
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


    /**
     * Vehicle constructor.
     * @param $_vehicleId
     * @param $_diagramId
     * @param $_make
     * @param $_yearMade
     * @param $_model
     * @param $_price
     * @param $_mileage
     * @param $_transmission
     * @param $_drivetrain
     * @param $_engineCapacity
     * @param $_category
     * @param $_cylinder
     * @param $_doors
     * @param $_status
     * @param $_dateAdded
     */
    public function __construct($_vehicleId, $_make, $_yearMade, $_model, $_price, $_mileage, $_transmission, $_drivetrain, $_engineCapacity, $_category, $_cylinder, $_doors, $_status, $_dateAdded)
    {
        $this->_vehicleId = $_vehicleId;
        $this->_make = $_make;
        $this->_yearMade = $_yearMade;
        $this->_model = $_model;
        $this->_price = $_price;
        $this->_mileage = $_mileage;
        $this->_transmission = $_transmission;
        $this->_drivetrain = $_drivetrain;
        $this->_engineCapacity = $_engineCapacity;
        $this->_category = $_category;
        $this->_cylinder = $_cylinder;
        $this->_doors = $_doors;
        $this->_status = $_status;
        $this->_dateAdded = $_dateAdded;
    }

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

    // function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    public function getHeadingTitle() {
        return $this->_yearMade . ' ' . $this->_make . ' ' . $this->_model;
    }

}