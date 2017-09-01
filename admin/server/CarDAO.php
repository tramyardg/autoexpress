<?php

require_once 'class/Utility.php';
require_once 'class/Dbh.php';
require_once 'class/Vehicle.php';
/**
 * Created by PhpStorm.
 * User: RAYMARTHINKPAD
 * Date: 2017-08-06
 * Time: 8:05 PM
 *
 * Contains managing data query functions
 * - add vehicle
 * - delete vehicle
 * - update vehicle
 * - select vehicle by id
 * - select all vehicle
 * - advanced search
 */
class CarDAO extends Utility
{

    // mostly used for select queries, mapping results to a class
    function query($sql)
    {
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $car = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $car[] = new Vehicle(
                $row["vehicleId"],
                $row["make"],
                $row["yearMade"],
                $row["model"],
                $row["price"],
                $row["mileage"],
                $row["transmission"],
                $row["drivetrain"],
                $row["engineCapacity"],
                $row["category"],
                $row["cylinder"],
                $row["doors"],
                $row["status"],
                $row["dateAdded"]
            );
        }
        $stmt = null;
        return $car;
    }

    function getAllCars()
    {
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `vehicle`;";
        return $this->query($sql);
    }

    function getCarById($id) {
        $sql = "SELECT * FROM `vehicle` WHERE `vehicleId` = $id";
        return $this->query($sql);
    }

    function create(&$valueObject) {
        $sql =   'INSERT  '  .
            '   INTO  '  .
            '     `vehicle`(`vehicleId`, `make`, `yearMade`, `model`, `price`, `mileage`,  '  .
            ' `transmission`, `drivetrain`,  `engineCapacity`,  `category`,  '  .
            ' `cylinder`, `doors`, `status`,  `dateAdded`  '  .
            '     )  '  .
            '   VALUES(  ';

        $sql = $sql."'".$valueObject->getVehicleId()."', ";
        $sql = $sql."'".$valueObject->getMake()."', ";
        $sql = $sql."'".$valueObject->getYearMade()."', ";
        $sql = $sql."'".$valueObject->getModel()."', ";
        $sql = $sql."'".$valueObject->getPrice()."', ";
        $sql = $sql."".$valueObject->getMileage().", ";
        $sql = $sql."'".$valueObject->getTransmission()."', ";
        $sql = $sql."'".$valueObject->getDrivetrain()."', ";
        $sql = $sql."'".$valueObject->getEngineCapacity()."', ";
        $sql = $sql."'".$valueObject->getCategory()."', ";
        $sql = $sql."".$valueObject->getCylinder().", ";
        $sql = $sql."".$valueObject->getDoors().", ";
        $sql = $sql."'".$valueObject->getStatus()."', ";
        $sql = $sql."'".$valueObject->getDateAdded()."') ";

        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isCreated($postArray) {
        $lastCarId = $this->getLastCarId();
        $car = new Vehicle(
            $this->incrementId($lastCarId),
            $postArray["make"],
            $postArray["year"],
            $postArray["model"],
            $postArray["price"],
            $postArray["mileage"],
            $postArray["transmission"],
            $postArray["drivetrain"],
            $postArray["capacity"],
            $postArray["category"],
            $postArray["cylinder"],
            $postArray["doors"],
            "Available", // default for adding
            $this->getTimeStamp()
        );

        $condition = 0;
        if($this->create($car)) {
            $condition = 1;
        }
        return $condition;
    }


    // one car can have many photos
    function addDiagram($files, $id) {

        if(!empty($files)) {
            $sql = null;

            for($i = 0; $i < count($files); $i++) {
                $imageData = $files[$i];
                $sql .= "INSERT INTO `cardiagram`(`diagram`, `vehicleId`) VALUES ('{$imageData}',{$id});";
            }

            $db = Dbh::getInstance();
            $stmt = $db->prepare($sql);
            $stmt->execute();
        }
    }

    function isDiagramAdded($files, $id) {
        if($this->isVehicleExist($id)) {
            echo 'here 1';
            $condition = 0;

            if($this->addDiagram($files, $id)) {
                $condition = 1;
            }
            return $condition;

        }
        return 0;
    }

    // TODO
    function update($id) {

    }

    function delete($id) {
        $sql = "DELETE FROM `vehicle` WHERE `vehicleId` = $id";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isDeleted($id) {
        if($this->isVehicleExist($id)) {
            $condition = 0;
            if($this->delete($id)) {
                $condition = 1;
            }
            return $condition;
        }
        return 0;

    }

    function countAllCars() {
        return count($this->getAllCars());
    }

    function getLastCarId() {
        $sql = "SELECT vehicleId FROM `vehicle` ORDER BY vehicleid DESC LIMIT 1";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    function getLastDiagramId() {
        $sql = "SELECT cardiagram.diagramId FROM cardiagram ORDER BY cardiagram.diagramId DESC LIMIT 1";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    // for registration if username is taken {boolean}
    function isVehicleExist($id)
    {
        $exists = 0;
        if (($this->getCarById($id))) {
            $exists = 1;
        }
        return $exists;
    }



}